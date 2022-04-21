<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Studentnum;
use Illuminate\Http\Request;

class StudentnumsController extends Controller
{
    public function index() {
        $studentnums = Studentnum::orderby('id', 'asc')
            ->get();

        return $studentnums->toJson();
    }
}
