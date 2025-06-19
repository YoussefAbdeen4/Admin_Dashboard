@extends('super.super')

@section('title','Create Product')

@section('content')
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputName">اسم المتنج</label>
            <input type="text" id="inputName" class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label for="inputDescription">وصف المنتج</label>
            <textarea id="inputDescription" class="form-control" rows="4" name="desc" required></textarea>
        </div>
        <div class="form-group">
            <label for="inputName">سعر المنتج</label>
            <input type="number" id="inputName" class="form-control" name="price">
        </div>
        <div class="form-group">
            <label for="inputName">كميه المنتج</label>
            <input type="number" id="inputName" class="form-control" name="quantity">
        </div>
        <div class="form-group">
            <label for="inputStatus">حاله المنتج</label>
            <select id="inputStatus" class="form-control custom-select" name="status">
                <option value="1">نشط</option>
                <option value="2">غير نشط</option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputName">صوره المنتج</label>
            <input type="file" id="myFile" name="img">
        </div>
        <div class="form-group">
            <input type="submit" value="اضافه هذا المنتج" class="btn btn-success float-left" name="add">
            <input type="submit" value="اضافه منتج اخر" class="btn btn-success float-right" name="return">
        </div>
    </form>
@endsection
