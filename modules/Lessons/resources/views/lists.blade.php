@extends('layouts.backend')
@section('content')
<p>
    <a href="{{ route('admin.courses.index') }}" class="btn btn-info text-white">Quay lại khóa học</a>
    <a href="{{ route('admin.lessons.create', $course) }}" class="btn btn-primary">Thêm mới</a>
</p>
@if (session('msg'))
<div class="alert alert-success">{{ session('msg') }}</div>
@endif
<table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Học thử</th>
            <th>Lượt xem</th>
            <th>Thứ tự</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Học thử</th>
            <th>Lượt xem</th>
            <th>Thứ tự</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </tfoot>

</table>
@endsection