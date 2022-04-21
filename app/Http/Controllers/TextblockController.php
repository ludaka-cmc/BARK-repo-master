<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Textblock;
use Illuminate\Http\Request;

class TextblockController extends Controller
{
    public function index() {
        $textblocks = Textblock::orderby('id', 'asc')
            ->get();

        return $textblocks->toJson();
    }
}
