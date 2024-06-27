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
                <h2 class="py-2">Danh sách đơn hàng</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th width="15%">Mã đơn hàng</th>
                            <th>Tổng tiền</th>
                            <th width="20%">Trạng thái</th>
                            <th width="20%">Thời gian</th>
                            <th width="10%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td><a href="#">#{{$order->id}}</a></td>
                            <td>{{money($order->total)}}</td>
                            <td>
                                <span class="badge bg-{{$order->status->color}}">
                                    {{$order->status->name}}
                                </span>
                            </td>
                            <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s')}}</td>
                            <td class="d-grid">
                                <a href="#" class="btn btn-outline-primary btn-sm">Chi tiết</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection