<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';
    protected $fillable = [
        'student_id'
    ];

    public function student() {
        return $this->belongsTo('AKCBark\Models\Student');
    }
}
