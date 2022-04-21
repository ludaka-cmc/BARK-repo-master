<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index() {
        $location = Location::orderby('id', 'asc')
            ->get();

        return $location->toJson();
    }
}
