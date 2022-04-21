<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class State extends Model
{
    use CrudTrait;

    protected $table = 'states';
    protected $fillable = [];

    public static function getStateIdFromStateTitle($title) {
        $state = State::where('title', $title)->first();

        return $state->id ?? 0;
    }
}
