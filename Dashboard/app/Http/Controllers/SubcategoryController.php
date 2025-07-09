<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditSubcategoryRequest;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Http\Traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    use media;

    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        /* get Subcategory */
        $subcategories = DB::table('subcatigories')->get();
        /* redirect to all view */
        return view('subcategory.all', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* get id & name_en of categoris */
        $categories = DB::table('catigories')->select('id', 'name_en')->get();
        /* redirect to create view */
        return view('subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcategoryRequest $request)
    {
        /* upload photo */
        $imgName = $this->uploadPhoto($request->img, 'subcategories');
        /* store data */
        $data = $request->except('img', 'button', '_token');
        $data['img'] = $imgName;
        DB::table('subcatigories')->insert($data);
        /* redirect */
        if ($request->button == 'all') {
            return redirect()->route('subcategory.all')->with('successes', 'successful operation');
        } else {
            return redirect()->back()->with('successes', 'successful operation');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        /* get categories and  subcategory */
        $categories = DB::table('catigories')->select('id', 'name_en')->get();
        $subcategory =  DB::table('subcatigories')->where('id', $id)->first();
        /* redirect */
        return view('subcategory.edit', compact('categories', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditSubcategoryRequest $request,  $id)
    {
        /* if photo exist delete old */
        $data = $request->except('img','_method','_token');
        if ($request->has('img')) {
            $oldName = DB::table('subcatigories')->where('id', $id)->select('img')->first()->img;
            $imgPath = public_path("/dist/img/subcategories/") . $oldName;
            $this->deletePhoto($imgPath);
            /* uploade new photo */
            $imgName = $this->uploadPhoto($request->img,'subcategories');
            $data['img']=$imgName;
        }
        /* update subcategory */
        DB::table('subcatigories')->where('id',$id)->update($data);
        /* redirect */
        return redirect()->route('subcategory.all')->with('successes', 'successful operation');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        /* delete photo */
        $oldName = DB::table('subcatigories')->where('id', $id)->select('img')->first()->img;
        $imgPath = public_path("/dist/img/subcategories/") . $oldName;
        $this->deletePhoto($imgPath);
        /* delete from database */
        DB::table('subcatigories')->where('id', $id)->delete();
        /* redirct */
        return redirect()->back()->with('successes', 'successful operation');
    }
}
