<?php

// Research page content: the R&D lab and future projects from the NeuroSky company profile.

$lab = 'NeuroSky R&D and Innovation Lab';

return [
    'heading' => 'Driving the future of logistics.',
    'intro' => 'Innovation never stops. Our R&D and Innovation Lab merges artificial intelligence, autonomous systems, and smart hardware to raise safety, efficiency, and intelligence across supply chains. Explore the projects we are building next.',
    'filters' => ['Route Intelligence', 'Driver Safety', 'Smart Hardware', 'Warehouse Automation', 'Supply Chain Security', 'Predictive Analytics'],
    'list_heading' => 'Projects',
    'spotlight' => [
        'slug' => 'autonomous-drone-assistance-for-navigation',
        'href' => '/insights/autonomous-drone-assistance-for-navigation',
        'tags' => ['Smart Hardware', 'Driver Safety'],
        'title' => 'Autonomous Drone Assistance for Navigation',
        'venue' => 'Future project',
        'authors' => $lab,
        'image' => 'profile/drone-flight.jpg',
    ],
    'featured' => [
        ['slug' => 'load-route', 'href' => '/insights/ai-powered-load-and-route-planning', 'tags' => ['Route Intelligence'], 'venue' => 'Future project', 'title' => 'AI-Powered Load & Route Planning', 'authors' => $lab, 'image' => 'profile/truck-driver-view.jpg', 'video' => ''],
        ['slug' => 'driver-behavior', 'href' => '/insights/driver-behavior-monitoring-to-prevent-accidents', 'tags' => ['Driver Safety'], 'venue' => 'Future project', 'title' => 'Driver Behavior Monitoring to Prevent Accidents', 'authors' => $lab, 'image' => 'profile/driver-tablet.jpg', 'video' => ''],
        ['slug' => 'rear-lcd', 'href' => '/insights/rear-lcd-display-for-truck-communication', 'tags' => ['Smart Hardware', 'Driver Safety'], 'venue' => 'Future project', 'title' => 'Rear LCD Display for Truck Communication', 'authors' => $lab, 'image' => 'profile/truck-rear-lcd.jpg', 'video' => ''],
        ['slug' => 'smart-warehouse', 'href' => '/insights/smart-warehouse-automation', 'tags' => ['Warehouse Automation'], 'venue' => 'Future project', 'title' => 'Smart Warehouse Automation', 'authors' => $lab, 'image' => 'profile/warehouse-automation.jpg', 'video' => ''],
        ['slug' => 'rnd-lab', 'href' => '/insights/inside-the-neurosky-rnd-and-innovation-lab', 'tags' => ['Predictive Analytics', 'Supply Chain Security'], 'venue' => 'R&D Lab', 'title' => 'Digital twins, blockchain, and predictive maintenance', 'authors' => $lab, 'image' => 'profile/team-laptops.jpg', 'video' => ''],
    ],
    'publications' => [
        ['slug' => 'drone', 'href' => '/insights/autonomous-drone-assistance-for-navigation', 'tags' => ['Smart Hardware', 'Driver Safety'], 'venue' => 'Future project', 'title' => 'Autonomous Drone Assistance for Navigation', 'authors' => $lab],
        ['slug' => 'load-route', 'href' => '/insights/ai-powered-load-and-route-planning', 'tags' => ['Route Intelligence'], 'venue' => 'Future project', 'title' => 'AI-Powered Load & Route Planning', 'authors' => $lab],
        ['slug' => 'driver-behavior', 'href' => '/insights/driver-behavior-monitoring-to-prevent-accidents', 'tags' => ['Driver Safety'], 'venue' => 'Future project', 'title' => 'Driver Behavior Monitoring to Prevent Accidents', 'authors' => $lab],
        ['slug' => 'rear-lcd', 'href' => '/insights/rear-lcd-display-for-truck-communication', 'tags' => ['Smart Hardware', 'Driver Safety'], 'venue' => 'Future project', 'title' => 'Rear LCD Display for Truck Communication', 'authors' => $lab],
        ['slug' => 'smart-warehouse', 'href' => '/insights/smart-warehouse-automation', 'tags' => ['Warehouse Automation'], 'venue' => 'Future project', 'title' => 'Smart Warehouse Automation: AGVs, AMRs, and AI-based inventory', 'authors' => $lab],
        ['slug' => 'traffic-prediction', 'href' => '/insights/inside-the-neurosky-rnd-and-innovation-lab', 'tags' => ['Route Intelligence', 'Predictive Analytics'], 'venue' => 'R&D Lab', 'title' => 'AI-driven traffic prediction', 'authors' => $lab],
        ['slug' => 'blockchain', 'href' => '/insights/inside-the-neurosky-rnd-and-innovation-lab', 'tags' => ['Supply Chain Security'], 'venue' => 'R&D Lab', 'title' => 'Blockchain for supply chain security', 'authors' => $lab],
        ['slug' => 'predictive-maintenance', 'href' => '/insights/inside-the-neurosky-rnd-and-innovation-lab', 'tags' => ['Predictive Analytics', 'Smart Hardware'], 'venue' => 'R&D Lab', 'title' => 'Predictive vehicle maintenance using sensor data', 'authors' => $lab],
        ['slug' => 'digital-twin', 'href' => '/insights/inside-the-neurosky-rnd-and-innovation-lab', 'tags' => ['Warehouse Automation', 'Predictive Analytics'], 'venue' => 'R&D Lab', 'title' => 'Digital twin models of warehouse operations', 'authors' => $lab],
        ['slug' => 'iot-ai-stack', 'href' => '/insights/inside-the-neurosky-rnd-and-innovation-lab', 'tags' => ['Smart Hardware'], 'venue' => 'R&D Lab', 'title' => 'IoT & AI stack: TensorFlow, OpenCV, ROS 2, and MQTT', 'authors' => $lab],
    ],
];
