@extends('layouts.client')
@section('content')
@include('parts.clients.page_title')
<section class="video">
    <div class="container">
        <h3>{{$lesson->name}}</h3>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="video-detail">
                    <video id="my-video" class="video-js" preload="auto" controls data-setup="{}">
                        <source src="/data/stream?video={{$lesson->video->url}}" type="video/mp4" />
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript
                        </p>
                    </video>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <p class="prev">Quay lại</p>
                    <p class="next">Tiếp theo</p>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="nav flex">
                    <p class="lesson active">Bài học</p>
                    <p class="document">Tài liệu</p>
                </div>
                <div class="group">
                    <div class="accordion active title">
                        @include('lessons::clients.lesson')
                    </div>
                    <div class="document-title title">
                        <p>tài liệu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
const myVideoEl = document.querySelector(
    '#my-video');
videojs(myVideoEl);
</script>
@endsection