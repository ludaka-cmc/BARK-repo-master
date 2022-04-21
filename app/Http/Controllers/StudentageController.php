<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Studentage;
use Illuminate\Http\Request;

class StudentageController extends Controller
{
    public function index() {
        $studentages = Studentage::orderby('id', 'asc')
            ->get();

        return $studentages->toJson();
    }
}
