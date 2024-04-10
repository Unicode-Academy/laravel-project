@extends('layouts.client')
@section('content')
@include('parts.clients.page_title')
<section class="course-detal">
    <div class="container">
        <div class="row relative">
            <div class="col-12 col-lg-9">
                <div class="submenu">
                    <ul>
                        <li>
                            <a href="#information">
                                <i class="fa-solid fa-file"></i> Thông tin chung
                            </a>
                        </li>
                        <li>
                            <a href="#curriculum">
                                <i class="fa-solid fa-book"></i>
                                Giáo trình
                            </a>
                        </li>
                        <li>
                            <a href="#author">
                                <i class="fa-solid fa-user"></i>
                                Giảng viên
                            </a>
                        </li>
                        <li>
                            <a href="#evaluate">
                                <i class="fa-solid fa-comment"></i>
                                Đánh giá
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="course-descreption" id="information">
                    <div class="course-content">
                        {!! $course->detail !!}
                    </div>

                </div>
                <div class="accordion" id="curriculum">
                    <div class="accordion-top">
                        <p>
                            <i class="fa-solid fa-book me-1"></i>
                            Gồm: {{getLessonCount($course)->module}} phần - {{getLessonCount($course)->lessons}} bài
                            giảng
                        </p>
                        <p>
                            <i class="fa-solid fa-clock me-1"></i>
                            Thời lượng {{getHour($course->durations)}}
                        </p>
                    </div>
                    @include('courses::clients.lesson')
                </div>
                <!-- <div class="course-video" id="author">
                    <h4>sản phẩm</h4>
                    <p class="course-content-infor">
                        Phòng bơm Cấp nước sinh hoạt, phòng Heat Pump, phòng bơm Chữa
                        cháy thuộc dự án Mikazuki Spa & Hotel Resort Đà Nẵng DSCons thực
                        hiện năm 2019.
                    </p>
                    <p class="video">
                        <iframe width="100%" height="515" src="https://www.youtube.com/embed/kYrC0s4B_-I"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen></iframe>
                    </p>
                </div> -->
            </div>
            <div class="col-12 col-lg-3">
                <div class="course-profile">
                    <div class="img">
                        <img src="{{$course->thumbnail}}" alt="" />
                    </div>
                    <div class="group-text">
                        <p class="price">
                            <i class="fa-solid fa-tag"></i>
                            @if ($course->sale_price)
                            <span class="sale">{{money($course->price)}}</span>
                            <span>{{money($course->sale_price)}}</span>
                            @else
                            <span>{{money($course->price)}}</span>
                            @endif
                        </p>
                        <p class="bookmark">
                            <i class="fa-solid fa-bookmark"></i>
                            Mã Khóa Học: {{$course->code}}
                        </p>
                        <!-- <p class="chart">
                            <i class="fa-solid fa-chart-simple"></i>
                            Cấp độ: Thực chiến
                        </p> -->
                        <p class="techer">
                            <i class="fa-solid fa-user"></i>
                            Giảng viên: {{$course->teacher->name.' - '.$course->teacher->exp}} năm kinh nghiệm
                        </p>
                        <p class="clock">
                            <i class="fa-solid fa-clock"></i>
                            Thời lượng: {{getHour($course->durations)}} học
                        </p>
                        <p>
                            <i class="fa-brands fa-hire-a-helper"></i>
                            Hỗ trợ: {{$course->supports}}
                        </p>
                        <p>
                            <i class="fa-brands fa-hire-a-helper"></i>
                            Tài liệu đính kèm: {{$course->is_document ? 'Có': 'Không'}}
                        </p>
                        <button class="payment">đặt mua khóa học</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
