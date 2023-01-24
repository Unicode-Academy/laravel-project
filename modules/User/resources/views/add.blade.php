@extends('layouts.backend')
@section('content')
<form action="" method="post">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" class="form-control" placeholder="Tên..." value="">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Email</label>
                <input type="text" class="form-control" placeholder="Email..." value="">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Nhóm</label>
                <select name="" id="" class="form-select">
                    <option value="">Chọn Nhóm</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="">Mật khẩu</label>
                <input type="password" name="" class="form-control" placeholder="Mật khẩu..." id="">
            </div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.users.index')}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
    
</form>
@endsection