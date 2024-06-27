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
                <h2 class="py-2">Khóa học của tôi</h2>
                <form action="" class="mb-3">
                    <div class="row">
                        <div class="col-3">
                            <select name="teacher_id" class="form-select js-select2">
                                <option value="">Tất cả giảng viên</option>
                                @foreach ($teacher as $item)
                                <option value="{{$item->id}}" {{request()->teacher_id == $item->id ? 'selected': ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-7">
                            <input type="search" name="keyword" class="form-control" placeholder="Tên khóa học..." value="{{request()->keyword}}" />
                        </div>
                        <div class="col-2 d-grid">
                            <button class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th>Tên</th>
                            <th width="25%">Giảng viên</th>
                            <th width="15%">Trạng thái</th>
                            <th width="10%">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $key => $course)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td><a href="/khoa-hoc/{{$course->slug}}">{{$course->name}}</a></td>
                            <td><a href="#">{{$course->teacher->name}}</a></td>
                            <td>{!!$course->pivot->status ? '<span class="badge bg-success">Hoạt động</span>': '<span class="badge bg-danger">Bị khóa</span>'!!}</td>
                            <td class="d-grid">
                                <a href="#" class="btn btn-outline-primary btn-sm">Vào học</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$courses->links('students::clients.pagination.bootstrap')}}
            </div>
        </div>
    </div>
</section>
@endsection