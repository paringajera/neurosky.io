<?php

// Insights index page extras (featured slides, updates list, closing media block).

$update = fn (string $slug, string $title, string $date) => [
    'href' => '/insights/'.$slug,
    'logo' => 'neurosky-profile-logo.png',
    'source' => 'NeuroSky',
    'title' => $title,
    'date' => $date,
];

return [
    'featured' => [
        ['slug' => 'introducing-next-fleet', 'image' => 'media/images/profile/warehouse-aisle-workers.jpg'],
        ['slug' => 'driver-behavior-monitoring-to-prevent-accidents', 'image' => 'media/images/profile/driver-tablet.jpg'],
        ['slug' => 'autonomous-drone-assistance-for-navigation', 'image' => 'media/images/profile/trucks-highway-aerial.jpg'],
        ['slug' => 'smart-warehouse-automation', 'image' => 'media/images/profile/warehouse-conveyor-team.jpg'],
        ['slug' => 'our-global-expansion-vision', 'image' => 'media/images/profile/containers.jpg'],
    ],
    'press_heading' => 'Updates',
    'press_href' => '/insights',
    'press' => [
        $update('introducing-next-fleet', 'Next Fleet brings fleet, warehouse, and workforce into one platform', 'October 20, 2026'),
        $update('driver-behavior-monitoring-to-prevent-accidents', 'Driver behavior AI targets fatigue, distraction, and over-speeding', 'October 6, 2026'),
        $update('autonomous-drone-assistance-for-navigation', 'Autonomous drones to give truck drivers a view of the road ahead', 'September 22, 2026'),
        $update('smart-warehouse-automation', 'Smart warehouse automation with AGVs, AMRs, and AI inventory', 'September 8, 2026'),
        $update('rear-lcd-display-for-truck-communication', 'Rear LCD displays to improve safety during overtakes', 'August 25, 2026'),
        $update('ai-powered-load-and-route-planning', 'AI load and route planning to cut empty miles', 'August 11, 2026'),
        $update('inside-the-neurosky-rnd-and-innovation-lab', 'Inside the NeuroSky R&D and Innovation Lab', 'July 28, 2026'),
        $update('our-global-expansion-vision', 'NeuroSky sets out its vision for Asia, the Middle East, and Africa', 'June 16, 2026'),
    ],
    'media' => [
        'image' => 'media/images/profile/team-laptops.jpg',
        'text' => 'Inside the NeuroSky R&D and Innovation Lab',
        'href' => '/insights/inside-the-neurosky-rnd-and-innovation-lab',
        'cta' => 'Read more',
    ],
];
