<?php

/*
|--------------------------------------------------------------------------
| Homepage content
|--------------------------------------------------------------------------
| Copy is taken from the NeuroSky company profile, the investor deck and the
| Next Fleet brochure. Images live in public/media/images (profile photos under
| profile/), see docs/asset-manifest.md.
*/

return [
    'hero' => [
        // red HUD film (from youtube.com/watch?v=NAmtBnzKxO4), self-hosted; posters are its first frames
        'video' => 'NeuroSky_Hero_HUD.mp4',
        'video_mobile' => 'NeuroSky_Hero_HUD_mobile.mp4',
        'image' => 'profile/hero-hud-poster.jpg',
        'image_mobile' => 'profile/hero-hud-poster-mobile.jpg',
        'tagline' => 'NeuroSky is building intelligent, connected logistics powered by AI.',
        'lines' => ['Never stop logistics.', 'Always move forward.'],
    ],

    'collage' => [
        'eyebrow' => 'Think different.',
        'body' => 'Our flagship logistics platform brings GPS tracking, smart truck systems, and smart warehouse management together in one connected, data-driven ecosystem. Whether it’s running fleet operations in real time or automating warehouse storage, NeuroSky helps businesses scale faster and smarter.',
        'columns' => [
            // column class, tiles (type => image|video)
            ['class' => '-left-340 md:left-24', 'parallax' => true, 'tiles' => [
                ['image' => 'profile/warehouse-floor.jpg'],
                ['image' => 'profile/truck-driver-view.jpg'],
                ['image' => 'profile/containers.jpg'],
                ['image' => 'profile/truck-india-driver.jpg'],
            ]],
            ['class' => '-left-110 md:left-[calc(16.667%)]', 'parallax' => false, 'tiles' => [
                ['image' => 'profile/truck-rear-lcd.jpg'],
                ['image' => 'profile/warehouse-aisle-workers.jpg'],
                ['image' => 'profile/driver-tablet.jpg'],
                ['image' => 'profile/warehouse-conveyor-team.jpg', 'class' => 'md:opacity-0'],
            ]],
            ['class' => '-right-110 md:right-[calc(16.667%)]', 'parallax' => false, 'tiles' => [
                ['image' => 'profile/warehouse-automation.jpg'],
                ['image' => 'profile/truck-yard-aerial.jpg'],
                ['image' => 'profile/warehouse-forklift.jpg'],
                ['image' => 'profile/warehouse-aisle-team.jpg'],
            ]],
            ['class' => '-right-340 md:right-24', 'parallax' => true, 'tiles' => [
                ['image' => 'profile/truck-india-colorful.jpg'],
                ['image' => 'profile/port-containers.jpg'],
                ['image' => 'profile/team-laptops.jpg'],
                ['image' => 'profile/truck-freight.jpg'],
            ]],
        ],
        'center_tile' => 'profile/truck-india-ghat.jpg',
    ],

    'benefits' => [
        'heading' => 'Logistics that thinks ahead.',
        'body' => 'Logistics is more than movement. It’s about precision, people, and performance. Our software is intelligent, scalable, and secure, built for the evolving needs of the logistics industry.',
        'image' => 'profile/warehouse-conveyor-team.jpg',
        'items' => [
            ['title' => 'Safe', 'body' => 'Driver behavior AI flags fatigue, distraction, over-speeding, and harsh braking in real time, helping cut accident risk by up to 30%.', 'image' => 'profile/driver-tablet.jpg'],
            ['title' => 'Smart', 'body' => 'Real-time tracking, automated load balancing, and AI route optimization reduce fuel and time wastage by up to 20%.', 'image' => 'profile/truck-driver-view.jpg'],
            ['title' => 'Scalable', 'body' => 'One cloud platform for fleet, warehouse, HR, and finance. Built for India, ready to grow from one city to a hundred countries.', 'image' => 'profile/warehouse-aisle-workers.jpg'],
        ],
    ],

    'technology' => [
        'heading' => 'The technology behind NeuroSky.',
        'image' => 'profile/warehouse-floor.jpg',
        'cta' => ['label' => 'Explore the tech', 'route' => 'research'],
        'cards' => [
            ['eyebrow' => 'Experience', 'title' => 'Next Fleet', 'image' => 'profile/truck-yard-aerial.jpg', 'href' => '/insights/introducing-next-fleet'],
            ['eyebrow' => 'Dive into', 'title' => 'Drone-Assisted Navigation', 'image' => 'profile/drone-flight.jpg', 'href' => '/insights/autonomous-drone-assistance-for-navigation'],
            ['eyebrow' => 'Meet the', 'title' => 'Smart Warehouse', 'image' => 'profile/warehouse-automation.jpg', 'href' => '/insights/smart-warehouse-automation'],
        ],
    ],

    'safety' => [
        'heading' => 'Putting driver safety first.',
        'image' => 'profile/truck-rear-lcd.jpg',
        'cta' => ['label' => 'Explore our approach', 'route' => 'safety'],
    ],

    // Who NeuroSky serves (target audience from the company profile), shown in the partner carousel.
    'partners' => [
        'heading' => 'Built for the businesses that keep India moving.',
        'body' => 'From fleet owners and warehouse managers to manufacturers and fast-growing startups, NeuroSky turns complex logistics into one smart, scalable system.',
        'interval' => 13400,
        'items' => [
            [
                'name' => 'Logistics',
                'image' => 'profile/truck-india-ghat.jpg',
                'logo' => 'profile/icon-logistics.svg',
                'quote' => 'Real-time GPS tracking, live ETAs, and AI route optimization give transport companies full control of every trip, from the first mile to the last.',
                'author' => 'Logistics & Transportation Companies',
                'role' => 'Fleet management, TMS, and proof of delivery',
                'cta' => '/insights/introducing-next-fleet',
            ],
            [
                'name' => 'Manufacturing',
                'image' => 'profile/containers.jpg',
                'logo' => 'profile/icon-manufacturing.svg',
                'quote' => 'Connected dispatch, freight billing, and end-to-end visibility keep raw materials and finished goods moving on schedule across every plant and distributor.',
                'author' => 'Manufacturing & Distribution Enterprises',
                'role' => 'Dispatch, freight billing, and reconciliation',
                'cta' => null,
            ],
            [
                'name' => 'Enterprises',
                'image' => 'profile/team-engineering.jpg',
                'logo' => 'profile/icon-enterprise.svg',
                'quote' => 'Customizable modules, role-based access, and third-party integration fit NeuroSky into existing systems, with unified dashboards for compliance and strategic insight.',
                'author' => 'Large Enterprises & Corporates',
                'role' => 'Custom workflows and system integration',
                'cta' => '/insights/why-businesses-choose-neurosky',
            ],
            [
                'name' => 'Warehousing',
                'image' => 'profile/warehouse-floor.jpg',
                'logo' => 'profile/icon-warehouse.svg',
                'quote' => 'Barcode and RFID tracking, dock scheduling, and predictive stock alerts help warehouse teams improve order fulfillment by 40% and reduce errors by 25%.',
                'author' => 'Warehousing & Inventory Managers',
                'role' => 'Smart warehouse automation',
                'cta' => '/insights/smart-warehouse-automation',
            ],
            [
                'name' => 'Startups',
                'image' => 'profile/warehouse-aisle-team.jpg',
                'logo' => 'profile/icon-startups.svg',
                'quote' => 'Cloud-based and mobile-ready, NeuroSky gives growing businesses enterprise-grade logistics tools without heavy upfront costs, and scales as they do.',
                'author' => 'Startups & Growing Businesses',
                'role' => 'SaaS and hardware-as-a-service plans',
                'cta' => null,
            ],
        ],
    ],

    'insights' => [
        'heading' => 'Insights.',
        'body' => 'Explore product deep dives, the projects in our R&D lab, and the ideas shaping the future of logistics.',
    ],

    'careers' => [
        'heading' => 'Build the future of logistics with us.',
        'cta' => ['label' => 'Join the team', 'route' => 'careers'],
        'interval' => 2000,
        'images' => [
            'profile/team-engineering.jpg',
            'profile/warehouse-supervisor.jpg',
            'profile/driver-tablet.jpg',
            'profile/warehouse-aisle-team.jpg',
            'profile/truck-driver-view.jpg',
            'profile/warehouse-aisle-workers.jpg',
        ],
    ],
];
