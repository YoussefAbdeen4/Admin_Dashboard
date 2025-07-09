<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    function all()
    {
        /* get users */
        $users = DB::table('users')->get();
        /* pass data to user view & redirect */
        return view('user.all', compact('users'));
    }

}
