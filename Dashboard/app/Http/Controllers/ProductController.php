<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class ProductController extends Controller
{
    use media;

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

    function store(StoreProductRequest $request)
    {
        /* upload photo */
        //dd($request->all());
        $imgName = $this->uploadPhoto($request->img, 'products');
        /* insert in database */
        $data = $request->except('_token', 'img', 'button');
        $data['img'] = $imgName;
        //dd($data);
        DB::table('products')->insert($data);

        /* redirect */

        if ($request->button == 'all') {
            return redirect()->route('product.all')->with('successes', 'successful operation');
        } else {
            return redirect()->back()->with('successes', 'successful operation');
        }
    }

    function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $subcategories = DB::table('subcatigories')->select('id', 'name_en')->where('status', 1)->get();
        return view('product.edit', compact('subcategories', 'product'));
    }

    function update(EditProductRequest $request, $id)
    {
        /* upload photo */
        $data = $request->except('_token', 'img', '_method');
        if ($request->has('img')) {
            $oldName = DB::table('products')->select('img')->where('id', $id)->first()->img;
            $path = public_path('/dist/img/products/') . $oldName;
            $this->deletePhoto($path);
            $imgName = $this->uploadPhoto($request->img, 'products');
            $data['img'] = $imgName;
        }
        /* Update product */
        DB::table('products')->where('id', $id)->update($data);
        /* redirect */
        return redirect()->route('product.all')->with('successes', 'successful operation');
    }

    function delete($id)
    {
        //delete photo
        $oldName = DB::table('products')->select('img')->where('id', $id)->first()->img;
        $path = public_path('/dist/img/products/') . $oldName;
        $this->deletePhoto($path);
        //delete form database
        DB::table('products')->where('id', $id)->delete();
        //redirect
        return redirect()->back()->with('successes', 'successful operation');
    }
}
