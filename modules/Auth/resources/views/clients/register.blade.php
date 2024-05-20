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
        @if (session('msg'))
        <div class="alert alert-danger">{{session('msg')}}</div>
        @endif
        <form action="" method="post">
            <input type="text" name="name" placeholder="Tên" />
            @error('name')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror
            <input type="text" name="email" placeholder="Email" />
            @error('email')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror
            <input type="text" name="phone" placeholder="Số điện thoại" />
            @error('phone')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror
            <input type="password" name="password" placeholder="Mật khẩu" />
            @error('password')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror
            <input type="password" name="confirm_password" placeholder="Lặp lại mật khẩu" />
            @error('confirm_password')
            <span class="text-start text-danger mb-3">{{$message}}</span>
            @enderror
            <button type="submit">
                <i class="fa-solid fa-user"></i>
                Đăng kí
            </button>
            @csrf
        </form>
        <p class="sign-in">
            Bạn đã có tài khoản?
            <a href="{{route('clients.login')}}">Đăng nhập ngay</a>
        </p>
    </div>
</div>
@endsection