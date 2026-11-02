<?php

// Safety page content, written from the NeuroSky company profile and investor deck.

return [
    'hero' => ['heading' => 'Redefining road safety.', 'image' => 'profile/driver-tablet.jpg'],

    'stakes' => [
        'heading' => 'The stakes are real and rising.',
        'body' => 'Indian logistics loses lives, time, and money to problems that technology can already solve. It’s time for an approach built for the realities of our roads.',
        'stats' => [
            ['label' => 'percent of road accidents in India linked to commercial vehicle driver fatigue.', 'value' => '25%'],
            ['label' => 'percent of trucks in India that run empty, costing $5 billion every year.', 'value' => '35%'],
            ['label' => 'trillion rupees lost to traffic delays in Indian logistics every year.', 'value' => '1.47'],
        ],
    ],

    'dna' => [
        'heading' => 'Safety is core to our DNA.',
        'body' => 'We are developing solutions that merge artificial intelligence, autonomous systems, and smart hardware to raise safety, efficiency, and intelligence across the supply chain.',
        'steps' => [
            [
                'title' => 'Watching out for every driver.',
                'body' => 'Onboard sensors and AI analytics track fatigue, distraction, over-speeding, and harsh braking. Drivers get real-time alerts, and fleet managers get periodic safety reports, creating a proactive system that prevents accidents instead of reporting them.',
                'image' => 'profile/driver-tablet.jpg',
            ],
            [
                'title' => 'Talking to the traffic behind.',
                'body' => 'Large LCD screens on the back of the truck show live camera feeds, turn signals, and alert messages to following vehicles, so overtakes and lane changes happen with far better visibility.',
                'image' => 'profile/truck-rear-lcd.jpg',
            ],
            [
                'title' => 'Seeing the road ahead.',
                'body' => 'In hilly terrain, traffic jams, or construction zones, an autonomous drone flies ahead of the truck and streams a clear view of the road to the driver’s dashboard, helping prevent accidents in low-visibility conditions.',
                'image' => 'profile/drone-flight.jpg',
            ],
        ],
    ],

    'technology' => [
        'heading' => 'Technology designed to protect.',
        'body' => 'Learn how our platform and smart hardware deliver a safer path forward for drivers, cargo, and everyone sharing the road.',
        'cta' => ['label' => 'Explore our approach', 'route' => 'insights.index'],
        'cards' => [
            ['title' => 'Driver Behavior AI', 'image' => 'profile/truck-driver-view.jpg', 'href' => '/insights/driver-behavior-monitoring-to-prevent-accidents', 'body' => 'AI monitors fatigue, speeding, and distractions in real time and has the potential to reduce accident risk by up to 30%. Every alert also builds accountability, with safety reports that help fleets coach drivers and improve over time.'],
            ['title' => 'Rear LCD Display', 'image' => 'profile/truck-rear-lcd.jpg', 'href' => '/insights/rear-lcd-display-for-truck-communication', 'body' => 'Live feeds and smart signals on the back of the truck tell following vehicles exactly what is happening ahead, making overtakes and lane changes safer on busy highways.'],
            ['title' => 'Drone-Assisted Navigation', 'image' => 'profile/drone-flight.jpg', 'href' => '/insights/autonomous-drone-assistance-for-navigation', 'body' => 'First-in-class autonomous drones fly ahead to capture the road beyond blind curves and blockages, enhancing driver visibility in low-light or blocked terrain zones.'],
        ],
    ],

    'practices' => [
        'title' => 'Safety-first best practices.',
        'slides' => [
            ['subtitle' => 'Monitor', 'body' => 'Onboard sensors and AI watch for fatigue, distraction, over-speeding, and harsh braking on every trip.', 'image' => 'profile/truck-driver-view.jpg'],
            ['subtitle' => 'Alert', 'body' => 'Real-time alerts reach the driver and the control room, with an SOS alert system for emergencies.', 'image' => 'profile/driver-tablet.jpg'],
            ['subtitle' => 'Communicate', 'body' => 'Rear LCD displays and drone feeds give drivers and following vehicles a clear picture of the road.', 'image' => 'profile/truck-rear-lcd.jpg'],
            ['subtitle' => 'Improve', 'body' => 'Periodic safety reports and predictive maintenance turn every trip into data that makes the next one safer.', 'image' => 'profile/truck-yard-aerial.jpg'],
        ],
    ],

    'insights' => ['heading' => 'Insights', 'body' => 'Explore product deep dives, safety innovation, and the ideas shaping the future of logistics.'],
];
