<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes;

    protected $table = 'guardians';
    protected $fillable = [
        'name',
        'release_form',
        'program_id',
        'relationship',
        'state_id'
    ];

    public function program() {
        return $this->belongsTo('AKCBark\Models\Program');
    }

    public function state() {
        return $this->belongsTo('AKCBark\Models\State');
    }
}
