<?php

// Company page content, taken from the NeuroSky company profile and investor deck.

return [
    'hero' => ['heading' => 'Think different.', 'image' => 'profile/team-engineering.jpg'],
    'intro' => 'Neuro Sky Technology Pvt. Ltd. is redefining the logistics landscape through innovation, intelligence, and cutting-edge technology. Our vision is a world where logistics operations are not just efficient but smart: trucks that think, plan, and act autonomously, warehouses that run on predictive intelligence, and every shipment tracked in real time with zero guesswork.',
    'quote' => [
        'image' => 'profile/warehouse-supervisor.jpg',
        'text' => '"With our future projects, we aim to revolutionize logistics through AI, automation, and safety-focused innovation. We are not just keeping up with the future. We are building it."',
        'author' => 'Neuro Sky Technology',
        'role' => 'Ahmedabad, India',
    ],
    'people' => [
        'heading' => 'The people moving us forward.',
        'body' => 'Behind every module are engineers, AI researchers, and logistics specialists who know that logistics is about precision, people, and performance, and who build software tailored to the industry’s real needs.',
        'cta' => ['label' => 'Learn more', 'route' => 'careers'],
        'images' => ['profile/team-engineering.jpg', 'profile/warehouse-aisle-team.jpg'],
    ],
    // Platform modules (company profile + Next Fleet brochure), shown in the logo marquee.
    'investors' => [
        'heading' => 'One connected platform.',
        'body' => 'GPS tracking, smart trucks, and smart warehouses work together with operations, HR, accounting, and third-party integrations in a single cloud and mobile platform.',
        'logos' => [
            ['file' => 'profile/module-fleet-management.svg', 'alt' => 'Fleet Management'],
            ['file' => 'profile/module-gps-tracking.svg', 'alt' => 'Real-time GPS Tracking'],
            ['file' => 'profile/module-smart-warehouse.svg', 'alt' => 'Smart Warehouse'],
            ['file' => 'profile/module-route-optimizer.svg', 'alt' => 'AI Route Optimizer'],
            ['file' => 'profile/module-driver-safety.svg', 'alt' => 'Driver Safety AI'],
            ['file' => 'profile/module-drone-navigation.svg', 'alt' => 'Drone Navigation'],
            ['file' => 'profile/module-rear-lcd.svg', 'alt' => 'Rear LCD Display'],
            ['file' => 'profile/module-tms.svg', 'alt' => 'Transport Management'],
            ['file' => 'profile/module-operations.svg', 'alt' => 'Operations Management'],
            ['file' => 'profile/module-hr-payroll.svg', 'alt' => 'HR & Payroll'],
            ['file' => 'profile/module-e-invoicing.svg', 'alt' => 'E-Invoicing & Accounting'],
            ['file' => 'profile/module-integrations.svg', 'alt' => 'Third-Party Integration'],
        ],
    ],
    'insights' => ['heading' => 'The latest from NeuroSky.', 'body' => 'Product news, safety innovation, and the projects coming out of our R&D lab.'],
    'locations' => [
        'heading' => 'From Ahmedabad to the world.',
        'body' => 'Our headquarters is in Ahmedabad, Gujarat. From here we are expanding into India’s tier-1 logistics hubs, and next across Asia, the Middle East, and Africa.',
        'map' => 'map-india.svg',
        'map_alt' => 'Map of India',
        'width' => 1000,
        'height' => 1117,
        // pin centres as % of the map box (projected from city coordinates, see docs/asset-manifest.md)
        'pins' => [
            ['name' => 'Ahmedabad (HQ)', 'left' => 15.9, 'top' => 46.47],
            ['name' => 'Delhi', 'left' => 31.37, 'top' => 28.44],
            ['name' => 'Mumbai', 'left' => 16.93, 'top' => 59.18],
            ['name' => 'Bengaluru', 'left' => 32.63, 'top' => 78.88],
            ['name' => 'Hyderabad', 'left' => 35.63, 'top' => 64.63],
            ['name' => 'Kolkata', 'left' => 68.53, 'top' => 47.92],
        ],
        // highway-style routes from the Ahmedabad HQ to each tier-1 hub, drawn one after another
        'routes' => [
            'M159.0 519.1C165.3 509.7 179.1 486.2 197.0 462.9C214.9 439.5 246.9 403.1 266.3 378.9C285.8 354.7 305.8 327.9 313.7 317.7',
            'M159.0 519.1C162.4 523.3 177.9 533.5 179.3 544.6C180.8 555.7 169.3 566.3 167.7 585.7C166.0 605.1 169.1 648.4 169.3 661.0',
            'M159.0 519.1C162.4 523.3 167.1 531.9 179.3 544.6C191.6 557.4 220.3 580.8 232.3 595.4C244.3 610.0 237.2 621.7 251.3 632.2C265.5 642.7 299.8 643.5 317.3 658.5C334.8 673.4 349.8 711.3 356.3 721.9',
            'M159.0 519.1C160.4 530.2 160.5 558.7 167.7 585.7C174.8 612.7 194.2 654.3 202.0 681.2C209.8 708.0 211.1 730.7 214.7 746.7C218.2 762.8 218.4 769.3 223.3 777.4C228.2 785.4 236.1 786.7 244.0 795.0C251.9 803.4 259.7 815.3 270.7 827.4C281.7 839.6 300.7 858.8 310.0 867.8C319.3 876.7 323.6 878.9 326.3 881.1',
            'M159.0 519.1C162.4 523.3 161.1 542.8 179.3 544.6C197.6 546.4 235.8 522.9 268.7 529.9C301.5 536.8 344.3 577.6 376.3 586.4C408.4 595.2 433.9 584.7 461.0 582.8C488.1 580.9 513.6 584.2 539.0 574.9C564.4 565.6 588.9 533.6 613.3 527.0C637.7 520.4 673.3 533.9 685.3 535.3',
        ],
    ],
];
