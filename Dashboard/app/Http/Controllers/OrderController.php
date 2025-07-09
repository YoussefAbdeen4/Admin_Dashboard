<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    function all()
    {
        $orders = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('products', 'products.id', '=', 'orders.product_id') // هنا التصحيح
            ->select( 'orders.id','orders.user_id','users.name','orders.product_id', 'products.name_en', 'orders.created_at')
            ->get();

        return view('order.all',compact('orders'));
    }
}
