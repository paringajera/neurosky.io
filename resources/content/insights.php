<?php

// NeuroSky articles, written from the company profile, investor deck and Next Fleet brochure.
// Article bodies live in resources/views/content/insights/{slug}.blade.php

$author = ['author' => 'NeuroSky', 'author_image' => 'apple-touch-icon.png', 'intro' => []];

return [
    [
        'slug' => 'introducing-next-fleet',
        'title' => 'Introducing Next Fleet: one platform for fleet, warehouse, and workforce',
        'date' => '2026-10-20',
        'tags' => ['Company news', 'Platform'],
        'image' => 'profile/truck-yard-aerial.jpg',
        'contexts' => ['company'],
    ] + $author,
    [
        'slug' => 'driver-behavior-monitoring-to-prevent-accidents',
        'title' => 'Driver behavior monitoring: preventing accidents before they happen',
        'date' => '2026-10-06',
        'tags' => ['Safety', 'Technology'],
        'image' => 'profile/driver-tablet.jpg',
        'contexts' => ['safety'],
    ] + $author,
    [
        'slug' => 'autonomous-drone-assistance-for-navigation',
        'title' => 'Autonomous drones that see the road ahead',
        'date' => '2026-09-22',
        'tags' => ['Technology', 'Safety'],
        'image' => 'profile/drone-flight.jpg',
        'contexts' => ['safety'],
    ] + $author,
    [
        'slug' => 'smart-warehouse-automation',
        'title' => 'Smart warehouse automation, from goods receipt to dispatch',
        'date' => '2026-09-08',
        'tags' => ['Technology', 'Platform'],
        'image' => 'profile/warehouse-automation.jpg',
        'contexts' => [],
    ] + $author,
    [
        'slug' => 'rear-lcd-display-for-truck-communication',
        'title' => 'Rear LCD displays: helping trucks talk to the traffic behind them',
        'date' => '2026-08-25',
        'tags' => ['Safety', 'Technology'],
        'image' => 'profile/truck-rear-lcd.jpg',
        'contexts' => ['safety'],
    ] + $author,
    [
        'slug' => 'ai-powered-load-and-route-planning',
        'title' => 'AI-powered load and route planning for fuller, faster trucks',
        'date' => '2026-08-11',
        'tags' => ['Technology'],
        'image' => 'profile/truck-driver-view.jpg',
        'contexts' => [],
    ] + $author,
    [
        'slug' => 'inside-the-neurosky-rnd-and-innovation-lab',
        'title' => 'Inside the NeuroSky R&D and Innovation Lab',
        'date' => '2026-07-28',
        'tags' => ['Research'],
        'image' => 'profile/team-laptops.jpg',
        'contexts' => ['company'],
    ] + $author,
    [
        'slug' => 'the-hidden-cost-of-inefficient-logistics-in-india',
        'title' => 'The hidden cost of inefficient logistics in India',
        'date' => '2026-07-14',
        'tags' => ['Industry'],
        'image' => 'profile/containers.jpg',
        'contexts' => ['safety'],
    ] + $author,
    [
        'slug' => 'why-businesses-choose-neurosky',
        'title' => 'Why businesses choose NeuroSky as their logistics technology partner',
        'date' => '2026-06-30',
        'tags' => ['Company news'],
        'image' => 'profile/team-engineering.jpg',
        'contexts' => ['company'],
    ] + $author,
    [
        'slug' => 'our-global-expansion-vision',
        'title' => 'From India to the world: our global expansion vision',
        'date' => '2026-06-16',
        'tags' => ['Company news'],
        'image' => 'profile/port-containers.jpg',
        'contexts' => ['company'],
    ] + $author,
];
