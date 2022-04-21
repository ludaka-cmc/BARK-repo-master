<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    const TYPE_IMAGE = 'image';

    protected $fillable = [
        'user_id',
        'name',
        'file',
        'filetype',
        'url',
        'preview_url',
        'preview'
    ];
}
