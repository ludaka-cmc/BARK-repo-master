<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$secret = '48OJq37jAcs30F8nQIiIPkXOORxba5d7';

return [
    'secret' => env('JWT_SECRET', $secret),
    'signature' => env('JWT_SECRET', $secret),
    'issuer' => env('JWT_ISSUER', env('APP_URL', 'http://localhost/')),
    'audience' => env('JWT_AUDIENCE', env('APP_URL', 'http://localhost/')),
    'not_before' => env('JWT_NOT_BEFORE', 0),
    'ttl' => env('JWT_EXPIRATION_TIME', 60*60*6), // 6 Hours
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'user' => 'AKCBark\Models\User',
    'identifier' => 'id',
    'required_claims' => ['iss', 'iat', 'exp', 'nbf', 'sub', 'jti'],
    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),
    'providers' => [
        'user' => 'Tymon\JWTAuth\Providers\User\EloquentUserAdapter',
        'jwt' => 'Tymon\JWTAuth\Providers\JWT\NamshiAdapter',
        'auth' => 'Tymon\JWTAuth\Providers\Auth\IlluminateAuthAdapter',
        'storage' => 'Tymon\JWTAuth\Providers\Storage\IlluminateCacheAdapter',
    ],
];
