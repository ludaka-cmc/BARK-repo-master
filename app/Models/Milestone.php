<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Milestone extends Model
{
    use SoftDeletes;
    protected $table = 'milestones';
    protected $fillable = [
        'title',
        'description',
        'num_hours',
    ];
}
