#!/usr/bin/env bash
# One-step setup / update for Hostinger. Run from the site folder over SSH:
#   bash deploy/hostinger.sh
# Safe to run again after every deploy.
set -euo pipefail
cd "$(dirname "$0")/.."

echo "1/5 Installing PHP packages"
composer install --no-dev --optimize-autoloader --no-interaction

echo "2/5 Settings file"
if [ ! -f .env ]; then
    cp deploy/env.production .env
    php artisan key:generate --force
else
    echo "    .env already exists, left unchanged"
fi

echo "3/5 Folder permissions"
mkdir -p storage/framework/{cache/data,sessions,views} storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "4/5 Caching config, routes and views"
php artisan optimize:clear >/dev/null
php artisan optimize

echo "5/5 Checking built assets"
if [ -f public/build/manifest.json ]; then
    echo "    public/build is present"
else
    echo "    WARNING: public/build/manifest.json is missing. Run 'npm run build' locally and push." >&2
fi

echo "Done. Open https://neurosky.io to check the site."
