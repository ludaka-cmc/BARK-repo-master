<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dog extends Model
{
    use SoftDeletes;

    protected $table = 'dogs';
    protected $fillable = [
        'name',
        'breed',
        'media_id',
        'volunteer_id',
        'certifications',
        'registration_number',
        'active',
        'state'
    ];

    public function volunteer() {
        return $this->belongsTo('AKCBark\Models\Volunteer');
    }

    public function state() {
        return $this->belongsTo('AKCBark\Models\State');
    }

    public function media() {
        return $this->belongsTo('AKCBark\Models\Media');
    }

    public function getMediaUrlLink() {
        return '<a href="'.url($this->media->url).'" target="_blank">'.$this->media->url.'</a>';
    }
}
