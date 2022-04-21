<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $table = 'notes';
    protected $fillable = [
        'title',
        'body',
        'dog_id',
        'student_id',
    ];

    public function dog() {
        return $this->belongsTo('AKCBark\Models\Dog');
    }

    public function student() {
        return $this->belongsTo('AKCBark\Models\Student');
    }
}
