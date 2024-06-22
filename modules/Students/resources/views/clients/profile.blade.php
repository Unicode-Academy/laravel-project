@extends('layouts.client')
@section('content')
@include('parts.clients.page_title')
<section class="all-course py-2">
    <div class="container">
        <div class="row">
            <div class="col-3">
                @include('students::clients.menu')
            </div>
            <div class="col-9 account-page">
                <h2 class="py-2">Thông tin cá nhân</h2>
                <button class="btn btn-warning my-3 js-profile-btn">Cập nhật thông tin</button>
                <div class="js-profile profile-item active">
                    <table class="table table-bordered ">
                        <tr>
                            <td width="25%">Tên</td>
                            <td>
                                {{$student->name}}
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                {{$student->email}}
                            </td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td>
                                {{$student->phone}}
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>
                                {{$student->address ?? "Chưa cập nhật"}}
                            </td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>
                                Đang hoạt động
                            </td>
                        </tr>
                        <tr>
                            <td>Thời gian đăng ký</td>
                            <td>
                                {{Carbon\Carbon::parse($student->created_at)->format('d/m/Y H:i:s')}}
                            </td>
                        </tr>
                        <tr>
                            <td>Thời gian kích hoạt</td>
                            <td>
                                {{Carbon\Carbon::parse($student->email_verified_at)->format('d/m/Y H:i:s')}}
                            </td>
                        </tr>
                    </table>
                </div>
                <form action="" class="js-profile profile-item" method="POST">
                    <table class="table table-bordered">
                        <tr>
                            <td width="25%">Tên</td>
                            <td>
                                <input type="text" name="name" class="form-control" placeholder="Tên..." value="{{$student->name}}">
                                <span class="error error-name text-danger"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" name="email" class="form-control" placeholder="Email..." value="{{$student->email}}">
                                <span class="error error-email text-danger"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td>
                                <input type="text" name="phone" class="form-control" placeholder="Điện thoại..." value="{{$student->phone}}">
                                <span class="error error-phone text-danger"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ</td>
                            <td>
                                <input type="text" name="address" class="form-control" placeholder="Địa chỉ..." value="{{$student->address}}">
                                <span class="error error-address text-danger"></span>
                            </td>
                        </tr>
                    </table>
                    <button class="js-btn-update btn btn-primary">Cập nhật thông tin</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection