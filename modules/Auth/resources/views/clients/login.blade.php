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
        <h3>Đăng nhập</h3>
        <form action="">
            <input type="text" placeholder="Email/Username" />
            <input type="text" placeholder="Mật khẩu" />
            <div class="checker">
                <input type="checkbox" />
                <span>Tự động đăng nhập</span>
            </div>
            <p class="forgot-password">Quên mật khẩu đăng nhập</p>
            <button type="submit">Đăng nhập</button>
        </form>
        <p class="sign-up">
            Bạn chưa có tài khoản?
            <a href="{{route('clients.register')}}">Đăng kí ngay</a>
        </p>
    </div>
</div>
@endsection
