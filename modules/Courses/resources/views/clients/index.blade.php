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
                            <p><i class="fa-solid fa-clock"></i>1,5h học</p>
                            <p><i class="fa-solid fa-video"></i>4 phần/18 bài</p>
                            <p><i class="fa-solid fa-eye"></i>1000</p>
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
                            <span class="sale">{{number_format($course->price).'đ'}}</span>
                            <span>{{number_format($course->sale_price). 'đ'}}</span>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endsection