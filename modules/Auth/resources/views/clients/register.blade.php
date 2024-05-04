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
    <div class="sign-up">
        <h3>Đăng kí</h3>
        <form action="">
            <input type="text" placeholder="Họ và tên đệm" />
            <input type="text" placeholder="Tên" />
            <input type="text" placeholder="Email" />
            <input type="text" placeholder="Số điện thoại" />
            <input type="text" placeholder="Mật khẩu" />
            <input type="text" placeholder="Lặp lại mật khẩu" />
            <button type="submit">
                <i class="fa-solid fa-user"></i>
                Đăng kí
            </button>
        </form>
        <p class="sign-in">
            Bạn đã có tài khoản?
            <a href="{{route('clients.login')}}">Đăng nhập ngay</a>
        </p>
    </div>
</div>
@endsection
