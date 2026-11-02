#!/usr/bin/env bash
# Builds the ready-to-run `production` branch for Hostinger shared hosting and pushes it.
# Run locally from the project:   bash deploy/build-production.sh
#
# The branch contains everything the server needs, so deploying is only `git pull`:
#   - the code from `main` (including the built assets in public/build)
#   - vendor/ installed without dev packages, for PHP 8.3+
# It never contains .env: that file holds the secret APP_KEY and is created once on the server.
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

if [ -n "$(git status --porcelain)" ]; then
    echo "Commit or stash your changes on main first." >&2
    exit 1
fi

SOURCE_SHA="$(git rev-parse --short main)"
WT="$(mktemp -d)/production"

git fetch -q origin || true
if git show-ref -q --verify refs/remotes/origin/production; then
    git worktree add -q -B production "$WT" origin/production
else
    git worktree add -q -b production "$WT" main
fi
trap 'git -C "$ROOT" worktree remove --force "$WT" >/dev/null 2>&1 || true' EXIT

cd "$WT"

# Replace everything with the current main.
git rm -rq --cached . >/dev/null 2>&1 || true
find . -mindepth 1 -maxdepth 1 ! -name .git -exec rm -rf {} +
git -C "$ROOT" archive main | tar -x -C "$WT"

echo "Installing PHP packages (no dev packages)"
composer install --no-dev --optimize-autoloader --no-interaction --quiet

# Never ship cached config: it stores absolute paths from this machine.
rm -f bootstrap/cache/config.php bootstrap/cache/routes-*.php bootstrap/cache/events.php

[ -f public/build/manifest.json ] || { echo "public/build is missing; run npm run build on main." >&2; exit 1; }

# Force-add ignored build output (vendor/), but never any .env file.
git add -A -f .
git rm -rq --cached --ignore-unmatch .env .env.* >/dev/null
git add -f .env.example 2>/dev/null || true
if git diff --cached --name-only | grep -qE '(^|/)\.env$'; then
    echo "Refusing to commit a .env file." >&2
    exit 1
fi
if git diff --cached --quiet; then
    echo "Production branch already matches main ($SOURCE_SHA)."
else
    git commit -q -m "Production build of main $SOURCE_SHA"
    echo "Built production from main $SOURCE_SHA"
fi
git push -q -u origin production
echo "Pushed. On the server run:  git pull"
