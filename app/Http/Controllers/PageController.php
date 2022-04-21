<?php

namespace AKCBark\Http\Controllers;
use AKCBark\Models\Page;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        $pages = Page::orderby('id', 'asc')
            ->get();

        return $pages->toJson();
    }
}
