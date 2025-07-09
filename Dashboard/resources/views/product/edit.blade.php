@extends('super.super')

@section('title','Edit Product')

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
    @include('includes.includes')
    <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-6">
                <label for="name_en"> Name_en </label>
                <input type="text" id="name_en" class="form-control" name="name_en"  value="{{$product->name_en}}">
            </div>
            <div class="col-6">
                <label for="name_ar"> Name_ar </label>
                <input type="text" id="name_ar" class="form-control" name="name_ar" value="{{$product->name_ar}}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="price"> Price </label>
                <input type="number" id="price" class="form-control" name="price" value="{{$product->price}}">
            </div>
            <div class="col-6">
                <label for="quantity"> Quantity </label>
                <input type="number" id="quantity" class="form-control" name="quantity" value="{{$product->quantity}}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="status"> Status </label>
                <select class="form-control" id="status" name="status">
                    <option {{$product->status==1?"selected":""}} value="1">Active</option>
                    <option {{$product->status==0?"selected":""}} value="0">Not Active</option>
                </select>
            </div>
            <div class="col-6">
                <label for="subcategories"> Subcategory </label>
                <select class="form-control" id="subcategories" name="subcatigory_id">
                    @foreach($subcategories as $subcategory)
                        <option {{$product->subcatigory_id==$subcategory->id?"selected":""}} value="{{$subcategory->id}}">{{$subcategory->name_en}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="desc_en">Desc_en </label>
                <textarea type="text" id="desc_en" class="form-control" name="desc_en" >{{$product->desc_en}}</textarea>
            </div>
            <div class="col-6">
                <label for="desc_ar">Desc_ar</label>
                <textarea type="text" id="desc_ar" class="form-control" name="desc_ar" >{{$product->desc_ar}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <label for="img"> Image </label>
                <input type="file" id="img" class="form-control" name="img" >
            </div>
            <div class="col-4">
                <img src="{{url("dist/img/products/$product->img")}}" alt="{{$product->name_en}}" class="w-100">
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <button type="submit"  class="btn btn-warning my-4">Update Product</button>
            </div>

        </div>
    </form>
@endsection
