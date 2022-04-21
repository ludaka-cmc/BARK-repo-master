<?php

namespace AKCBark\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Breed extends Model
{
    use SoftDeletes;

    protected $table = 'breeds';

    public function getBreeds() {
        $breeds = Breed::orderby('breed_name', 'asc')
            ->get();

       return $breeds->toJson();
    }
}
