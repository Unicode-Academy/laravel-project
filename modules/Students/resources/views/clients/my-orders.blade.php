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
                <form action="" class="mb-2">
                    <div class="row">
                        <div class="col-3">
                            <select name="status_id" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                @foreach ($ordersStatus as $status)
                                <option value="{{$status->id}}" {{request()->status_id == $status->id ? 'selected': ''}}>{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="text" class="datepicker-1 form-control" name="start_date" placeholder="Từ ngày..." value="{{request()->start_date}}" />
                        </div>
                        <div class="col-2">
                            <input type="text" class="datepicker-2 form-control" name="end_date" placeholder="Đến ngày..." value="{{request()->end_date}}" />
                        </div>
                        <div class="col-3">
                            <input type="number" class="form-control" name="total" placeholder="Tổng tiền..." value="{{request()->total}}" />
                        </div>
                        <div class="col-2">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                            <td><a href="{{route('students.account.order-detail', $order->id)}}">#{{$order->id}}</a></td>
                            <td>{{money($order->total)}}</td>
                            <td>
                                <span class="badge bg-{{$order->status->color}}">
                                    {{$order->status->name}}
                                </span>
                            </td>
                            <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s')}}</td>
                            <td class="d-grid">
                                <a href="{{route('students.account.order-detail', $order->id)}}" class="btn btn-outline-primary btn-sm">Chi tiết</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$orders->links('students::clients.pagination.bootstrap')}}
            </div>
        </div>
    </div>
</section>
@endsection