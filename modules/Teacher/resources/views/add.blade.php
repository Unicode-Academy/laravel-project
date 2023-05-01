@extends('layouts.backend')
@section('content')
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" name="name"
                        class="form-control title {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Tên..."
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug"
                        class="form-control slug {{ $errors->has('slug') ? 'is-invalid' : '' }}" placeholder="Slug..."
                        value="{{ old('slug') }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Số năm kinh nghiệm</label>
                    <input type="number" name="exp" class="form-control {{ $errors->has('exp') ? 'is-invalid' : '' }}"
                        placeholder="Số năm kinh nghiệm..." value="{{ old('exp') }}">
                    @error('exp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Mô tả</label>
                    <textarea name="description" class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        placeholder="Mô tả...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <div class="row {{ $errors->has('image') ? 'align-items-center' : 'align-items-end' }}">
                        <div class="col-7">
                            <label for="">Hình ảnh</label>
                            <input type="text" name="image"
                                class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}"
                                placeholder="Hình ảnh..." id="image" value="{{ old('image') }}">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="image"
                                data-preview="holder">
                                Chọn ảnh
                            </button>
                        </div>
                        <div class="col-3">
                            <div id="holder">
                                @if (old('thumbnail'))
                                    <img src="{{ old('thumbnail') }}" />
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.teacher.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
    </form>
@endsection
