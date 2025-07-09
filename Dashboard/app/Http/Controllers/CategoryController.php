<?php

namespace App\Http\Controllers;

use App\Http\Traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
     use media;

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        /* get Subcategory */
        $categories = DB::table('catigories')->get();
        /* redirect to all view */
        return view('category.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* redirect to create view */
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        /* upload photo */
        $imgName = $this->uploadPhoto($request->img, 'categories');
        /* store data */
        $data = $request->except('img', 'button', '_token');
        $data['img'] = $imgName;
        DB::table('catigories')->insert($data);
        /* redirect */
        if ($request->button == 'all') {
            return redirect()->route('category.all')->with('successes', 'successful operation');
        } else {
            return redirect()->back()->with('successes', 'successful operation');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        /* get categories */
        $category =  DB::table('catigories')->where('id', $id)->first();
        /* redirect */
        return view('category.edit', compact( 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditCategoryRequest $request,  $id)
    {
        /* if photo exist delete old */
        $data = $request->except('img','_method','_token');
        if ($request->has('img')) {
            $oldName = DB::table('catigories')->where('id', $id)->select('img')->first()->img;
            $imgPath = public_path("/dist/img/categories/") . $oldName;
            $this->deletePhoto($imgPath);
            /* uploade new photo */
            $imgName = $this->uploadPhoto($request->img,'categories');
            $data['img']=$imgName;
        }
        /* update subcategory */
        DB::table('catigories')->where('id',$id)->update($data);
        /* redirect */
        return redirect()->route('category.all')->with('successes', 'successful operation');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        /* delete photo */
        $oldName = DB::table('catigories')->where('id', $id)->select('img')->first()->img;
        $imgPath = public_path("/dist/img/categories/") . $oldName;
        $this->deletePhoto($imgPath);
        /* delete from database */
        DB::table('catigories')->where('id', $id)->delete();
        /* redirct */
        return redirect()->back()->with('successes', 'successful operation');
    }
}
