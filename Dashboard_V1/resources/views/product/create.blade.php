@extends('super.super')

@section('title','Create Product')

@section('content')
    <div class="col-12">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-6">
                <label for="name_en"> Name_en </label>
                <input type="text" id="name_en" class="form-control" name="name_en" >
            </div>
            <div class="col-6">
                <label for="name_ar"> Name_ar </label>
                <input type="text" id="name_ar" class="form-control" name="name_ar" >
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="price"> Price </label>
                <input type="number" id="price" class="form-control" name="price" >
            </div>
            <div class="col-6">
                <label for="quantity"> Quantity </label>
                <input type="number" id="quantity" class="form-control" name="quantity" >
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="status"> Status </label>
                <select class="form-control" id="status" name="status">
                    <option value="1">Active</option>
                    <option value="0">Not Active</option>
                </select>
            </div>
            <div class="col-6">
                <label for="subcatigories"> Subcategory </label>
                <select class="form-control" id="subcatigories" name="subcatigory_id">
                    @foreach($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">{{$subcategory->name_en}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="desc_en">Desc_en </label>
               <textarea type="text" id="desc_en" class="form-control" name="desc_en" ></textarea>
            </div>
            <div class="col-6">
                <label for="desc_ar">Desc_ar</label>
                <textarea type="text" id="desc_ar" class="form-control" name="desc_ar" ></textarea>
            </div>
        </div>
        <div class="form-row">
            <label for="img"> Image </label>
            <input type="file" id="img" class="form-control" name="img" >
        </div>
        <div class="form-row">
            <div class="col-6">
                <button type="submit" value="all" class="btn btn-primary my-4" name="button">Add Product</button>
            </div>
            <div class="col-6">
                <button type="submit" value="back" class="btn btn-success my-4" name="button">Add and Return</button>
            </div>
        </div>
    </form>
@endsection
