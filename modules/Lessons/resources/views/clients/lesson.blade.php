@foreach (getModuleByPosition($course) as $key => $module)
<div class="accordion-group">
    <h4 class="accordion-title {{$module->id == $lesson->parent_id ? 'active': ''}}">{{$module->name}}</h4>
    <div class="accordion-detail" style="{{$module->id == $lesson->parent_id ? 'display: block;':''}}">
        @foreach (getLessonsByPosition($course, $module->id) as $item)
        <div class="card-accordion px-2 {{$item->id == $lesson->id ? 'active': ''}}">
            <div class="align-items-start">
                <i class="fa-brands fa-youtube me-2"></i>
                <a class="text-dark"
                    href="{{route('lesson.index', $item->slug)}}">{{"Bài ".(++$index).": ".$item->name}}</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach