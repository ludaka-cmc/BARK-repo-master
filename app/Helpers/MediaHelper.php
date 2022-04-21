<?php

namespace AKCBark\Helpers;

use AKCBark\Models\Media;
use Storage;

class MediaHelper
{
    public static function handleImageUpload($image, $user_id) {
        $filename = $image->getClientOriginalName();

        $imagename = str_replace('.', '_', microtime(true)) . '_' . rand(0, 10000) . '.jpg';
        $mimetype = explode('/', $image->getMimeType());

        if ($mimetype[0] != 'image') {
            throw new \Exception('Invalid image format.');
        }

        $env = env('APP_ENV', '');

        $folder = ($env == 'production')
            ? 's3'
            : $env;

        $key = "{$folder}/{$user_id}/{$imagename}";

        $bucket = env('AWS_BUCKET', '');
        $url = "http://{$bucket}.s3.amazonaws.com/{$key}";

        if (Storage::disk('s3')->put($key, file_get_contents($image))) {
            return $media = Media::create([
                'user_id' => $user_id,
                'url' => $url,
                'type' => 'image',
                'file' => $image,
                'name' => $imagename
            ]);
        }

        return null;
    }
}
