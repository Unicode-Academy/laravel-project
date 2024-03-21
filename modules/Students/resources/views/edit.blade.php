@extends('layouts.backend')
@section('content')
@section('content')
@if (session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<form action="" method="post">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" class="form-control {{$errors->has('name')?'is-invalid':''}}"
                    placeholder="Tên..." value="{{old('name', $student->name)}}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control {{$errors->has('email')?'is-invalid':''}}"
                    placeholder="Email..." value="{{old('email', $student->email)}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Trạng thái</label>
                <select name="status" id="" class="form-select {{$errors->has('status')?'is-invalid':''}}">
                    <option value="0" {{old("status", $student->status) == 0 ? 'selected': ''}}>Chưa kích hoạt</option>
                    <option value="1" {{old("status", $student->status) == 1 ? 'selected': ''}}>Kích hoạt</option>
                </select>
                @error('status')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" class="form-control {{$errors->has('password')?'is-invalid':''}}"
                    placeholder="Mật khẩu..." id="">
                @error('password')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Địa chỉ</label>
                <input type="text" name="address" class="form-control {{$errors->has('address')?'is-invalid':''}}"
                    placeholder="Địa chỉ..." value="{{old('address', $student->address)}}">
                @error('address')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Điện thoại</label>
                <input type="text" name="phone" class="form-control {{$errors->has('phone')?'is-invalid':''}}"
                    placeholder="Điện thoại..." value="{{old('phone', $student->phone)}}">
                @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.students.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
    @method('PUT')
    @csrf
</form>
@endsection