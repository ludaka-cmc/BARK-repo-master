<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Helpers\MediaHelper;
use AKCBark\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function index() {
        $media = Media::all();

        return $media->toJson();
    }

    public function image(Request $request) {
        $media = MediaHelper::uploadImage(
            $this->user,
            $request->fileBase64,
            $request->caption
        );

        Log::info(['media' => $media]);
    }
}
