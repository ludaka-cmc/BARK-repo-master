<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certification extends Model
{
    use SoftDeletes;

    protected $table = 'certifications';
    protected $fillable = [
        'title',
        'description',
        'url',
        'tooltip_text'
    ];
}
