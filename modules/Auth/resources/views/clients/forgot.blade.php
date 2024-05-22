@extends('layouts.auth_clients')
@section('content')
<div class="container">
    <div class="home-back">
        <a href="{{route('home')}}">
            <span>
                <i class="fa-solid fa-arrow-left"></i>
            </span>
            Về trang chủ
        </a>
    </div>
    <div class="sign-in">
        <h3>Quên mật khẩu</h3>
        <p class="mb-3">Vui lòng nhập email để đặt lại mật khẩu</p>
        @if (session('msg'))
        <div class="alert alert-danger">{{session('msg')}}</div>
        @endif
        <form action="" method="post">
            <input type="text" name="email" placeholder="Email..." />
            @error('email')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror

            <button type="submit">Xác nhận</button>
            @csrf
        </form>
        <p class="sign-up">
            <a href="{{route('clients.login')}}">Quay lại đăng nhập</a>
        </p>
    </div>
</div>
@endsection