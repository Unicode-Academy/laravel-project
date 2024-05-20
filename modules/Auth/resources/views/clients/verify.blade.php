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
    <div class="sign-in w-50">
        <h1>Vui lòng kích hoạt tài khoản</h1>
        <h3 class="mt-2">Hãy kiểm tra email để kích hoạt tài khoản</h3>
    </div>
</div>
@endsection