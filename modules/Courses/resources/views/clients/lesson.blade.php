@foreach (getModuleByPosition($course) as $key => $module)
<div class="accordion-group">
    <h4 class="accordion-title {{$key == 0 ? 'active': ''}}">{{$module->name}}</h4>
    <div class="accordion-detail" style="{{$key == 0 ? 'display: block;':''}}">
        @foreach (getLessonsByPosition($course, $module->id) as $lesson)
        <div class="card-accordion">
            <div>
                <i class="fa-brands fa-youtube"></i>
                {{"Bài ".(++$index).": ".$lesson->name}}
                {!!$lesson->is_trial ? '<p>Học thử</p>': ''!!}
                <span>{{getTime($lesson->durations)}}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach
