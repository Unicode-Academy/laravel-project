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
        <h1>Tài khoản của bạn đã bị khóa</h1>
        <h3 class="mt-2">Vui lòng liên hệ CSKH để được hỗ trợ</h3>
    </div>
</div>
@endsection