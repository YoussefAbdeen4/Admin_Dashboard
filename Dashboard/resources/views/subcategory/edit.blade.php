@extends('super.super')

@section('title', 'Edit Subcategory')

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
    <form method="post" action="{{ route('subcategory.update',$subcategory->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-6">
                <label for="name_en"> Name_en </label>
                <input type="text" id="name_en" class="form-control" name="name_en" value="{{ $subcategory->name_en }}">
            </div>
            <div class="col-6">
                <label for="name_ar"> Name_ar </label>
                <input type="text" id="name_ar" class="form-control" name="name_ar" value="{{ $subcategory->name_ar }}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <label for="status"> Status </label>
                <select class="form-control" id="status" name="status">
                    <option {{ $subcategory->status  == 1 ? 'selected' : '' }} value="1">Active</option>
                    <option {{ $subcategory->status == 0 ? 'selected' : '' }} value="0">Not Active</option>
                </select>
            </div>
            <div class="col-6">
                <label for="catigories"> Category </label>
                <select class="form-control" id="catigories" name="catigory_id">
                    @foreach ($categories as $category)
                        <option {{ $subcategory->catigory_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                            {{ $category->name_en }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="co-12">
                <label for="img"> Image </label>
                <input type="file" id="img" class="form-control" name="img">
            </div>
            <div class="col-4">
                <img src="{{ url("dist/img/subcategories/$subcategory->img") }}" alt="{{ $subcategory->name_en }}"
                    class="w-100">
            </div>
        </div>
        <div class="form-row">
            <div class="col-6">
                <button type="submit" class="btn btn-primary my-4">Edit Subcategory</button>
            </div>
        </div>
    </form>
@endsection
