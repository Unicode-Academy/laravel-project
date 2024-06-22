@extends('layouts.client')
@section('content')
@include('parts.clients.page_title')
<section class="all-course py-2">
    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('students::clients.menu')
            </div>
            <div class="col-9">
                <h2 class="py-2">Đổi mật khẩu</h2>
                @if (session('msg'))
                <div class="alert alert-{{session('msgType')}}">{{session('msg')}}</div>
                @endif
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Mật khẩu cũ</label>
                        <input type="password" name="old_password" class="form-control" placeholder="Mật khẩu cũ...">
                        @error('old_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới...">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Nhập lại mật khẩu mới</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu mới...">
                        @error('confirm_password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</section>
@endsection