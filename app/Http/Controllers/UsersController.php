<?php

namespace AKCBark\Http\Controllers;

use AKCBark\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('id', 'asc')
            ->get();

        foreach ($users as $user) {
            $user->gigyaUser;
            $user->volunteer;
            $user->totalHours();
            $user->totalPages();
        }

        return $users->toJson();
    }
}
