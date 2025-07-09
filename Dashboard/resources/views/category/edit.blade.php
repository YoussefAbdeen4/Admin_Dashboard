@extends('super.super')

@section('title', 'Edit category')

@section('content')
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @include('includes.includes')
    <form method="post" action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-6">
                <label for="name_en"> Name_en </label>
                <input type="text" id="name_en" class="form-control" name="name_en" value="{{ $category->name_en }}">
            </div>
            <div class="col-6">
                <label for="name_ar"> Name_ar </label>
                <input type="text" id="name_ar" class="form-control" name="name_ar" value="{{ $category->name_ar }}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-12">
                <label for="status"> Status </label>
                <select class="form-control" id="status" name="status">
                    <option {{ $category->status  == 1 ? 'selected' : '' }} value="1">Active</option>
                    <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                </select>
            </div>
        </div>
         <div class="form-row">
            <div class="col-12">
                <label for="img"> Image </label>
                <input type="file" id="img" class="form-control" name="img" >
            </div>
            <div class="col-4">
                <img src="{{url("dist/img/categories/$category->img")}}" alt="{{$category->name_en}}" class="w-100">
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <button type="mit" class="btn btn-primary my-4">Edit category</button>
            </div>
        </div>
    </form>
@endsection
