@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" name="name"
                        class="form-control title {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Tên..."
                        value="{{ old('name') ?? $course->name }}">
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
                        value="{{ old('slug') ?? $course->slug }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giảng viên</label>
                    <select name="teacher_id" id=""
                        class="form-select {{ $errors->has('teacher_id') ? 'is-invalid' : '' }}">
                        <option value="0">Chọn giảng viên</option>
                        @if ($teacher)
                            @foreach ($teacher as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('teacher_id') == $item->id || $course->teacher_id == $item->id ? 'selected' : false }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('teacher_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã khóa học</label>
                    <input type="text" name="code"
                        class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" placeholder="Mã khóa học..."
                        id="" value="{{ old('code') ?? $course->code }}">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khóa học</label>
                    <input type="number" name="price"
                        class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="Giá khóa học..."
                        id="" value="{{ old('price') ?? $course->price }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khuyến mãi</label>
                    <input type="number" name="sale_price"
                        class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}"
                        placeholder="Giá khuyến mãi..." id=""
                        value="{{ old('sale_price') ?? $course->sale_price }}">
                    @error('sale_price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tài liệu đính kèm</label>
                    <select name="is_document" id=""
                        class="form-select {{ $errors->has('is_document') ? 'is-invalid' : '' }}">
                        <option value="0"
                            {{ old('is_document') == 0 || $course->is_document == 0 ? 'selected' : false }}>Không</option>
                        <option value="1"
                            {{ old('is_document') == 1 || $course->is_document == 1 ? 'selected' : false }}>Có</option>
                    </select>
                    @error('is_document')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Trạng thái</label>
                    <select name="status" id=""
                        class="form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="0" {{ old('status') == 0 || $course->status == 0 ? 'selected' : false }}>Chưa
                            ra mắt</option>
                        <option value="1" {{ old('status') == 1 || $course->status == 1 ? 'selected' : false }}>Đã ra
                            mắt</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Hỗ trợ</label>
                    <textarea name="supports" class="form-control {{ $errors->has('supports') ? 'is-invalid' : '' }}"
                        placeholder="Hỗ trợ...">{{ old('supports') ?? $course->supports }}</textarea>
                    @error('supports')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Nội dung</label>
                    <textarea name="detail" class="form-control ckeditor {{ $errors->has('detail') ? 'is-invalid' : '' }}"
                        placeholder="Nội dung...">{{ old('detail') ?? $course->detail }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Chuyên mục</label>
                    <div class="list-categories">
                        {{ getCategoriesCheckbox($categories, old('categories') ?? $categoryIds) }}
                    </div>
                    @error('categories')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <div class="row {{ $errors->has('thumbnail') ? 'align-items-center' : 'align-items-end' }}">
                        <div class="col-7">
                            <label for="">Ảnh đại diện</label>
                            <input type="text" name="thumbnail"
                                class="form-control {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}"
                                placeholder="Ảnh đại diện..." id="thumbnail"
                                value="{{ old('thumbnail') ?? $course->thumbnail }}">
                            @error('thumbnail')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="thumbnail"
                                data-preview="holder">
                                Chọn ảnh
                            </button>
                        </div>
                        <div class="col-3">
                            <div id="holder">
                                @if (old('thumbnail') || $course->thumbnail)
                                    <img style="height: 5rem;" src="{{ old('thumbnail') ?? $course->thumbnail }}" />
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
        @method('PUT')
    </form>
@endsection
@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto !important;
        }

        #holder img {
            width: 100% !important;
        }
    </style>
@endsection
