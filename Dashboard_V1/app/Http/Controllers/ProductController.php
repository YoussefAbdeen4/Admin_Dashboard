<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    function all()
    {
        //get all products from db
        $products = DB::table('products')->get();
        //pass data to product view
        return view('product.all', compact('products'));
    }

    function create()
    {
        $subcategories = DB::table('subcatigories')->select('id', 'name_en')->where('status', 1)->get();
        return view('product.create', compact('subcategories'));
    }

    function store(Request $request)
    {
        /* validation */
        $rules = [
            'name_en' => ['required', 'string', 'max:256', 'min:4'],
            'name_ar' => ['required', 'string', 'max:256', 'min:4'],
            'desc_en' => ['required', 'string'],
            'desc_ar' => ['required', 'string'],
            'price' => ['required', 'numeric', 'max:9999.99', 'min:5'],
            'quantity' => ['nullable', 'integer', 'max:999', 'min:1'],
            'status' => ['required', 'integer', 'between:0,1'],
            'subcatigory_id' => ['required', 'integer' , 'exists:subcatigories,id'],
            'img'=>['required','max:1000','mimes:png,jpg,jpeg']
        ];
        $request->validate($rules);

        /* upload photo */
        //dd($request->all());
        $imgName = uniqid().'.'.$request->img->extension();
        $request->img->move(public_path('/dest/img/products'),$imgName);

        /* insert in database */
        $data = $request->except('_token','img','button');
        $data['img']=$imgName;
        //dd($data);
        DB::table('products')->insert($data);

        /* redirect */
        if ($request->button == 'all'){
            return redirect()->route('product.all');
        }else {
            return redirect()->back();
        }
    }

    function edit()
    {
        return view('product.edit');
    }
}
