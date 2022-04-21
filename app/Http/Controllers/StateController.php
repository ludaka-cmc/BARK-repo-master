<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index() {
        $states = State::orderby('id', 'asc')
            ->get();

        return $states->toJson();

        // $states_formatted = [];

        // foreach ($states as $state) {
        //     $states_formatted[$state['title']] = $state;
        // }

        // return json_encode($states_formatted);
    }
}
