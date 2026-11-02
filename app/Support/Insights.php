<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * File-backed repository for insight articles.
 *
 * Article metadata lives in resources/content/insights.php; long-form bodies
 * live in resources/views/content/insights/{slug}.blade.php so they stay
 * editable as plain HTML.
 */
class Insights
{
    protected ?Collection $items = null;

    public function all(?string $category = null): Collection
    {
        $items = $this->load();

        if ($category) {
            $items = $items->filter(fn (array $a) => in_array(Str::slug($category), array_map([Str::class, 'slug'], $a['tags'] ?? []), true));
        }

        return $items->values();
    }

    public function featured(int $limit = 9, ?string $context = null): Collection
    {
        $items = $this->load();

        if ($context) {
            $tagged = $items->filter(fn (array $a) => in_array($context, $a['contexts'] ?? [], true));
            if ($tagged->count() >= $limit) {
                $items = $tagged;
            }
        }

        return $items->take($limit)->values();
    }

    public function find(string $slug): ?array
    {
        return $this->load()->firstWhere('slug', $slug);
    }

    public function related(array $article, int $limit = 3): Collection
    {
        return $this->load()
            ->reject(fn (array $a) => $a['slug'] === $article['slug'])
            ->take($limit)
            ->values();
    }

    public function categories(): Collection
    {
        return $this->load()
            ->flatMap(fn (array $a) => $a['tags'] ?? [])
            ->unique()
            ->values();
    }

    protected function load(): Collection
    {
        if ($this->items === null) {
            $raw = require resource_path('content/insights.php');

            $this->items = collect($raw)
                ->map(function (array $a) {
                    $a['url'] = route('insights.show', $a['slug']);
                    $a['image_url'] = asset('media/images/'.$a['image']);
                    $a['body_view'] = view()->exists('content.insights.'.$a['slug']) ? 'content.insights.'.$a['slug'] : null;

                    return $a;
                })
                ->sortByDesc(fn (array $a) => $a['date'])
                ->values();
        }

        return $this->items;
    }
}
