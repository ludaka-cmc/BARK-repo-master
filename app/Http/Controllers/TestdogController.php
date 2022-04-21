<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Admin\Testdog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestdogController extends Controller
{
    public function index() {
        $dogs = Testdog::active()
            ->orderBy('id', 'asc')
            ->get();

        return $dogs->toJson();
    }

    public function show($id) {
        if ($dog = Testdog::find($id)) {
            return $dog->toJson();
        }

        return [];
    }
}
