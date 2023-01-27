@extends('layouts.backend')
@section('content')
<p><a href="{{route('admin.users.create')}}" class="btn btn-primary">Thêm mới</a></p>
@if (session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </tfoot>
    
</table>
@include('parts.backend.delete')
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
    $("#datatable").DataTable({
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: "{{route('admin.users.data')}}",
        columns: [
            {
                data: 'name',
            },
            {
                data: 'email',
            },
            {
                data: 'group_id',
            },
            {
                data: 'created_at',
            },
            {
                data: 'edit',
            },
            {
                data: 'delete',
            }
        ]
    });
});
</script>
@endsection