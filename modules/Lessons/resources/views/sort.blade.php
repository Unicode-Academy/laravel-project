@extends('layouts.backend')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <form action="" method="post">
        <div id="sortable-list" class="list-group mb-3">
            @foreach ($modules as $module)
                <div id="item-{{ $module->id }}" data-id="{{ $module->id }}" class="list-group-item title">
                    {{ $module->name }}
                    <input type="hidden" name="lesson[]" value="{{ $module->id }}">
                </div>
                @if ($module->children)
                    @foreach ($module->children as $lesson)
                        <div id="item-{{ $lesson->id }}" data-id="{{ $lesson->id }}" class="list-group-item children">
                            {{ $lesson->name }}
                            <input type="hidden" name="lesson[]" value="{{ $lesson->id }}">
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Lưu lại</button>
        <a href="{{ route('admin.lessons.index', $courseId) }}" class="btn btn-danger">Hủy</a>

        @csrf
    </form>
@endsection
@section('stylesheets')
    <style>
        .ghost {
            opacity: 0.4;
        }

        .list-group {
            margin-bottom: 20px;
        }

        .children {
            padding-left: 30px;
        }

        .title {
            font-weight: bold;
        }
    </style>
@endsection
@section('scripts')
    <script>
        $('#sortable-list').sortable({
            group: 'list',
            animation: 200,
            ghostClass: 'ghost',
            onSort: () => {
                console.log('Success');
            },
        });
    </script>
@endsection
