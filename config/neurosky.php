<?php

/*
|--------------------------------------------------------------------------
| Site content shared across pages (navigation, footer, announcement bar)
|--------------------------------------------------------------------------
| Company details come from the Neuro Sky Technology Pvt. Ltd. company profile.
| Asset paths point at local copies stored under public/media.
*/

return [
    'name' => 'NeuroSky',
    'title' => 'NeuroSky | AI-Powered Logistics Technology',
    'description' => 'Neuro Sky Technology builds intelligent logistics software: GPS tracking, smart trucks, smart warehouses, and driver safety AI in one connected platform.',

    'company' => [
        'legal_name' => 'Neuro Sky Technology Private Limited',
        'address' => '101, Chitrarath Complex, Nr. Hotel President, C. G. Road, Navrangpura, Ahmedabad - 380009',
        'phone' => '+91 99093 69456',
        'email' => 'cloud@neuroskytech.com',
    ],

    'banner' => [
        'text' => "Let's build smarter logistics",
        'cta' => 'Get in touch',
        'href' => 'mailto:cloud@neuroskytech.com',
    ],

    'nav' => [
        ['label' => 'Home', 'route' => 'home', 'thumb' => 'profile/trucks-highway-aerial.jpg'],
        ['label' => 'Safety', 'route' => 'safety', 'thumb' => 'profile/driver-tablet.jpg'],
        ['label' => 'Research', 'route' => 'research', 'thumb' => 'profile/drone-flight.jpg'],
        ['label' => 'Company', 'route' => 'company', 'thumb' => 'profile/team-engineering.jpg'],
        ['label' => 'Careers', 'route' => 'careers', 'thumb' => 'profile/warehouse-aisle-team.jpg'],
        ['label' => 'Insights', 'route' => 'insights.index', 'thumb' => 'profile/warehouse-aisle-workers.jpg'],
    ],

    // No NeuroSky social accounts are listed in the company profile; add them here when available.
    'social' => [],

    'footer' => [
        'heading' => "Never stop logistics.\nAlways move forward.",
        'contact' => 'Reach out directly at',
        'emails' => ['cloud@neuroskytech.com'],
        'video' => 'NeuroSky_System_LightTunnel_1.mp4',
    ],
];
