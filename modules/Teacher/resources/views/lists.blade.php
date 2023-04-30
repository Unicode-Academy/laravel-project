@extends('layouts.backend')
@section('content')
    <p><a href="{{ route('admin.teacher.create') }}" class="btn btn-primary">Thêm mới</a></p>
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Kinh nghiệm</th>

                <th>Thời gian</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Ảnh</th>
                <th>Tên</th>
                <th>Kinh nghiệm</th>

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
        $(document).ready(function() {
            $("#datatable").DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.teacher.data') }}",
                columns: [{
                        data: 'image',
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'exp',
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
