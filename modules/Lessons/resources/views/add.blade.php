@extends('layouts.backend')
@section('content')
<form action="" method="post">
    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="">Tên</label>
                <input type="text" name="name" class="form-control title {{$errors->has('name')?'is-invalid':''}}" placeholder="Tên..." value="{{old('name')}}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Slug</label>
                <input type="text" name="slug" class="form-control slug {{ $errors->has('slug') ? 'is-invalid' : '' }}" placeholder="Slug..." value="{{ old('slug') }}">
                @error('slug')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-4">
            <div class="mb-3">
                <label for="">Nhóm bài giảng</label>
                <select name="parent_id" class="form-select">
                    <option value="0">Trống</option>
                </select>
                @error('parent_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-4">
            <div class="mb-3">
                <label for="">Học thử</label>
                <select name="is_trial" class="form-select">
                    <option value="0">Không</option>
                    <option value="1">Có</option>
                </select>
                @error('is_trial')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-4">
            <div class="mb-3">
                <label for="">Sắp xếp</label>
                <input type="number" class="form-control" name="position" placeholder="Thứ tự..." />
                @error('position')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Video</label>
                <div class="input-group">
                    <input type="text" name="video" id="video-url" class="form-control" placeholder="Video bài giảng" />
                    <button type="button" class="btn btn-success" id="lfm-video" data-input="video-url">Chọn</button>
                </div>
                @error('video_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>

        <div class="col-6">
            <div class="mb-3">
                <label for="">Tài liệu</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="document-url" placeholder="Tài liệu bài giảng" />
                    <button class="btn btn-success" type="button" class="btn btn-success" id="lfm-document" data-input="document-url">Chọn</button>
                </div>
                @error('document_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror

            </div>
        </div>

        <div class="col-12">
            <div class="mb-3">
                <label for="">Mô tả</label>
                <textarea name="description" class="ckeditor"></textarea>
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>


        <div class="col-12">
            <button type="submit" class="btn btn-primary">Lưu lại</button>
            <a href="{{route('admin.lessons.index', $courseId)}}" class="btn btn-danger">Hủy</a>
        </div>
    </div>
    @csrf
</form>
@endsection