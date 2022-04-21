<?php

return [
    'api_key' => env('GIGYA_API_KEY', '3_nvR8gHZekV9v7I6rgSW4g2Of_q-7P0mcJW0XfwnX1MPaM3dKAsj_kp8nKAMNrnYA'),
    'api_secret' => env('GIGYA_API_SECRET', 'VP3PDgRo5sZMm+YhrTiKWsyqevoqm+Qx'),
    'modal_settings' => [
        'siteName' => env('GIGYA_SITE_NAME', 'local.reading.akc.org'),
        'enabledProviders' =>  env('GIGYA_ENABLED_PROVIDERS', '')
    ],
    'api_base_url' => 'https://accounts.us1.gigya.com/'
];
