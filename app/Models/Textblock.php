<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Textblock extends Model
{
    use SoftDeletes;

    protected $table = 'textblocks';

    protected $fillable = [
        'title',
        'description',
        'weight',
        'text',
        'page_id'
    ];

    public function page() {
        return $this->belongsTo('AKCBark\Models\Page');
    }
}
