@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')
    <section class="all-course py-2">
        <div class="container">
            <h2 class="py-2">Thanh toán đơn hàng <a
                    href="{{ route('students.account.order-detail', $id) }}">#{{ $id }}</a></h2>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h4 class="mb-3">Thông tin đơn hàng</h4>
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
                            </td>
                        </tr>
                    </table>
                    <h4 class="mb-3">Chi tiết đơn hàng</h4>
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
                <div class="col-6">
                    <h4 class="mb-3">Mã giảm giá</h4>
                    <form action="" class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nhập mã giảm giá...">
                        <button class="btn btn-success">Áp dụng</button>
                    </form>
                    <h4 class="mb-3">Thông tin thanh toán</h4>
                    <div class="row">
                        <div class="col-6">
                            <p>Quý khách vui lòng chuyển khoản tới số tài khoản bên dưới hoặc quét mã QR để thực hiện thanh
                                toán. Vui lòng nhập đúng số tiền và nội dung chuyển khoản</p>
                            <hr>
                            <p>- Ngân hàng Vietcombank - Chi nhánh Thăng Long</p>
                            <p>- Số tài khoản: 049100035576</p>
                            <p>- Chủ tài khoản: Tạ Hoàng An</p>
                            <p>- Số tiền: {{ money($order->total) }}</p>
                            <p>- Nội dung: thanh toan {{ $id }}</p>
                        </div>
                        <div class="col-6">
                            <img class="mt-3" style="width: 250px"
                                src="https://img.vietqr.io/image/vietcombank-049100035576-compact2.jpg?amount={{ $order->total }}&addInfo=thanh+toan+{{ $id }}"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
