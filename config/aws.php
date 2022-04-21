<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AWS SDK Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration options set in this file will be passed directly to the
    | `Aws\Sdk` object, from which all client objects are created. The minimum
    | required options are declared here, but the full set of possible options
    | are documented at:
    | http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/configuration.html
    |
    */

    'credentials' => [
        'key' => env('AWS_ACCESS_KEY_ID', ''),
        'secret' => env('AWS_SECRET_ACCESS_KEY', '')
    ],
    'region' => env('AWS_REGION', 'us-east-1'),
    'version' => 'latest',
    'bucket' => env('AWS_BUCKET', 'cdn-origin.images.akc.org'),

    'config_file' => null,

    /*
     * S3 Specific Settings
     */
    'public_domain' => env(
        'AWS_PUBLIC_DOMAIN',
        '//s3.amazonaws.com/cdn-origin.images.akc.org/reading'
    )
];
