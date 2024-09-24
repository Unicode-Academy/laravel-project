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
                    <div class="order-detail">
                        <h2 class="py-2">Đơn hàng</h2>
                        <h4 class="mb-3">Thông tin cơ bản</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th width="20%">ID đơn hàng</th>
                                <td>#{{ $order->id }}</td>
                            </tr>
                            <tr>
                                <th>Tổng đơn hàng</th>
                                <td>{{ money($order->total) }}</td>
                            </tr>
                            <tr>
                                <th>Thời gian đặt</th>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td><span class="badge bg-{{ $order->status->color }}">
                                        {{ $order->status->name }}
                                    </span>
                                    @if ($order->status->is_success == 0)
                                        <a href="{{ route('students.account.checkout', $order->id) }}"
                                            class="btn btn-success btn-sm">Thanh toán</a>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        <h4>Thông tin chi tiết</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th>Tên khóa học</th>
                                    <th>Giá</th>
                                    <th>Giảng viên</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->detail as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item?->course?->name }}</td>
                                        <td>{{ money($item->price) }}</td>
                                        <td>{{ $item?->course?->teacher?->name }}</td>
                                        <td><span
                                                class="badge bg-{{ $item->course?->status ? 'success' : 'danger' }}">{{ $item->course?->status ? 'Đang hoạt động' : 'Dừng hoạt động' }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="order-action">
                        <button class="btn btn-primary download-btn">Tải đơn hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
