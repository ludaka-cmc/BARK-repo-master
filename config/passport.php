<?php

return [
    'ttl' => env('TOKEN_TTL', 60*60*24), // 1 day
    'refresh_ttl' => env('REFRESH_TOKEN_TTL', 60*60*24*7), // 7 days
];
