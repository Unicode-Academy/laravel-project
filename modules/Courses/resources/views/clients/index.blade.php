@extends('layouts.client')
@section('content')
@include('parts.clients.page_title')
<section class="all-course">
    <div class="container">
        @if ($courses)
        <div class="row">
            @foreach ($courses as $course)
            <div class="col-12 col-lg-6">
                <div class="d-flex course">
                    <div class="banner-course">
                        <img src="{{$course->thumbnail}}" alt="{{$course->name}}" />
                    </div>
                    <div class="descreption-course">
                        <div class="descreption-top">
                            <p><i class="fa-solid fa-clock"></i> {{getHour($course->durations)}} học</p>
                            <p><i class="fa-solid fa-video"></i> {{getLessonCount($course)->module}}
                                phần/{{getLessonCount($course)->lessons}} bài</p>
                            <p><i class="fa-solid fa-eye"></i> {{$course->view ? number_format($course->view): 0}}</p>
                        </div>
                        <h5 class="descreption-title">
                            <a href="/khoa-hoc/{{$course->slug}}">
                                {{$course->name}}
                            </a>
                        </h5>
                        <div class="descreption-teacher">
                            <img src="{{$course->teacher?->image}}" alt="{{$course->teacher?->name}}" />
                            <span>{{$course->teacher?->name}}</span>
                        </div>
                        <p class="descreption-price">
                            @if ($course->sale_price)
                            <span class="sale">{{money($course->price)}}</span>
                            <span>{{money($course->sale_price)}}</span>
                            @else
                            <span>{{money($course->price)}}</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{$courses->links()}}
        </div>
        @endif
    </div>
</section>
@endsection
