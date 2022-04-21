<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $certifications = Certification::orderby('id', 'asc')
            ->get();

        return $certifications->toJson();
    }
}
