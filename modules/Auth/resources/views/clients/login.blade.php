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
        @if (session('msg'))
        <div class="alert alert-danger">{{session('msg')}}</div>
        @endif
        <form action="" method="post">
            <input type="text" name="email" placeholder="Email/Username" />
            @error('email')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror
            <input type="password" name="password" placeholder="Mật khẩu" />
            @error('password')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror
            <div class="checker">
                <input type="checkbox" name="remember" value="1" />
                <span>Tự động đăng nhập</span>
            </div>
            <p class="forgot-password">
                <a href="{{route('clients.password.forgot')}}">Quên mật khẩu đăng nhập</a>
            </p>
            <button type="submit">Đăng nhập</button>
            @csrf
        </form>
        <p class="sign-up">
            Bạn chưa có tài khoản?
            <a href="{{route('clients.register')}}">Đăng kí ngay</a>
        </p>
    </div>
</div>
@endsection
