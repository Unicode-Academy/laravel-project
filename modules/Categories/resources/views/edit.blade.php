@extends('layouts.backend')
@section('content')
@if (session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<form action="" method="post">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" class="form-control title {{$errors->has('name')?'is-invalid':''}}" placeholder="Tên..." value="{{old('name') ?? $category->name}}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                 </div>
                @enderror
               
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control slug {{$errors->has('slug')?'is-invalid':''}}" placeholder="Slug..." value="{{old('slug') ?? $category->slug}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                 </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Cha</label>
                <select name="parent_id" id="" class="form-select {{$errors->has('parent_id')?'is-invalid':''}}">
                    <option value="0">Không</option>
                    {{getCategories($categories, old('parent_id') ?? $category->parent_id)}}
                </select>
                @error('parent_id')
                <div class="invalid-feedback">
                    {{$message}}
                 </div>
                @enderror
            </div>
        </div>
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
    @csrf
    @method('PUT')
</form>
@endsection