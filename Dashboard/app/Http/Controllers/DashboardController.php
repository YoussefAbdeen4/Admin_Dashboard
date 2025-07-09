<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        $users = DB::table('users')->select(DB::raw('count(*) as users'))->first();
        $products = DB::table('products')->select(DB::raw('count(*) as products'))->first();
        $subcategories = DB::table('subcatigories')->select(DB::raw('count(*) as subcategories'))->first();
        $categories = DB::table('catigories')->select(DB::raw('count(*) as categories'))->first();
        $orders = DB::table('orders')->select(DB::raw('count(*) as orders'))->first();
        return view('dashboard',compact('users','products','subcategories','categories','orders'));
    }
}
