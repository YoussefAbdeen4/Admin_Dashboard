@extends('super.super')

@section('title','Create Category')

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
    <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-6">
                <label for="name_en"> Name_en </label>
                <input type="text" id="name_en" class="form-control" name="name_en"  value="{{old('name_en')}}">
            </div>
            <div class="col-6">
                <label for="name_ar"> Name_ar </label>
                <input type="text" id="name_ar" class="form-control" name="name_ar" value="{{old('name_ar')}}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <label for="status"> Status </label>
                <select class="form-control" id="status" name="status">
                    <option {{old('status')==1?"selected":""}} value="1">Active</option>
                    <option {{old('status')==0?"selected":""}} value="0">Not Active</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <label for="img"> Image </label>
            <input type="file" id="img" class="form-control" name="img" >
        </div>
        <div class="form-row">
            <div class="col-6">
                <button type="submit" value="all" class="btn btn-primary my-4" name="button">Add Category</button>
            </div>
            <div class="col-6">
                <button type="submit" value="back" class="btn btn-success my-4" name="button">Add and Return</button>
            </div>
        </div>
    </form>
@endsection
