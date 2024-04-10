@if ($course->lessons()->whereNull('parent_id')->count())
@foreach ($course->lessons()->whereNull('parent_id')->orderBy('position')->get() as $module)
@if ($module->parent_id == NULL)
<div class="accordion-group">
    <h4 class="accordion-title">{{$module->name}}</h4>
    <div class="accordion-detail">
        @foreach ($course->lessons()->whereNotNull('parent_id')->orderBy('position')->get() as $lesson)
        @if ($lesson->parent_id == $module->id)
        <div class="card-accordion">
            <div>
                <i class="fa-brands fa-youtube"></i>
                {{$lesson->name}}
                {!!$lesson->is_trial ? '<p>học thử</p>': ''!!}
                <span>{{getTime($lesson->durations)}}</span>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endif
@endforeach
@endif
