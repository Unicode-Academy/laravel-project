@foreach (getModuleByPosition($course) as $key => $module)
<div class="accordion-group">
    <h4 class="accordion-title {{$key == 0 ? 'active': ''}}">{{$module->name}}</h4>
    <div class="accordion-detail" style="{{$key == 0 ? 'display: block;':''}}">
        @foreach (getLessonsByPosition($course, $module->id) as $lesson)
        <div class="card-accordion">
            <div>
                <i class="fa-brands fa-youtube"></i>
                {{"Bài ".(++$index).": ".$lesson->name}}
                {!!$lesson->is_trial ? '<p class="trial-btn" data-id="'.$lesson->id.'">Học thử</p>': ''!!}
                <span>{{getTime($lesson->durations)}}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach
@section('scripts')
<script>
const trialBtnList = document.querySelectorAll('.trial-btn');
if (trialBtnList.length) {
    trialBtnList.forEach((trialBtn) => {
        trialBtn.addEventListener('click', (e) => {
            const id = e.target.dataset.id;
            const modalEl = document.querySelector('#modal');
            const modal = new bootstrap.Modal(modalEl);

            //Call tới Server để trả về video (csrf token)

            const url = "{{route('courses.data.trial')}}/" + id;
            fetch(url).then((response) => {
                return response.json()
            }).then(data => {
                if (data.is_trial != 1) {
                    alert('Không được phép học thử');
                    return;
                }
                modal.show();
                modalEl.querySelector('.modal-title').innerText = 'Học thử';
                modalEl.querySelector('.modal-body').innerText = 'Video';
            });

        })
    })
}
</script>
@endsection
