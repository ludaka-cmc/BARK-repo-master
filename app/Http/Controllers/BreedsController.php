<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Breed;
use Illuminate\Http\Request;

class BreedsController extends Controller
{
    public function index() {
        $breeds = Breed::orderby('id', 'asc')
            ->get();

        return $breeds->toJson();
    }
}
