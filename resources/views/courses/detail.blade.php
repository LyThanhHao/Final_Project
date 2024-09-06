@extends('layouts/userLO')

@section('main')
    <style>
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* From Uiverse.io by vinodjangid07 */
        .readmore-btn {
            width: -webkit-fill-available;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background-color: rgb(125, 144, 255);
            border: none;
            border-radius: 10px;
            padding: 0px 15px;
            gap: 0px;
            transition: all 0.4s;
        }

        .book-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            position: relative;
            width: 45px;
            height: 100%;
        }

        .book-wrapper .book-page {
            width: 50%;
            height: auto;
            position: absolute;
        }

        .readmore-btn:hover .book-page {
            animation: paging 0.4s linear infinite;
            transform-origin: left;
        }

        .readmore-btn:hover {
            background-color: rgb(61, 65, 250);
        }

        @keyframes paging {
            0% {
                transform: rotateY(0deg) skewY(0deg);
            }

            50% {
                transform: rotateY(90deg) skewY(-20deg);
            }

            100% {
                transform: rotateY(180deg) skewY(0deg);
            }
        }

        .text {
            width: 105px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 15px;
            color: white;
        }

        .enroll-btn {
            border: none;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 5px;
            text-transform: uppercase;
            cursor: pointer;
            color: #2c9caf;
            transition: all 1000ms;
            font-size: 8px;
            position: relative;
            overflow: hidden;
            outline: 2px solid #2c9caf;
            line-height: 2;
            font-size: 13px;
        }

        .enroll-btn:hover {
            color: #ffffff;
            transform: scale(1.1);
            outline: 2px solid #70bdca;
            box-shadow: 4px 5px 17px -4px #268391;
        }

        .enroll-btn::before {
            content: "";
            position: absolute;
            left: -50px;
            top: 0;
            width: 0;
            height: 100%;
            background-color: #2c9caf;
            transform: skewX(45deg);
            z-index: -1;
            transition: width 1000ms;
        }

        .enroll-btn:hover::before {
            width: 250%;
        }

        .button-message a .btn-send {
            width: -webkit-fill-available;
            height: 40px;
            border: 1px solid #2e2afa;
            border-radius: 45px;
            transition: all 0.3s;
            cursor: pointer;
            background: #0505f5;
            font-size: 1em;
            font-weight: 550;
            font-family: 'Montserrat', sans-serif;
            color: white
        }

        .button-message a .btn-send:hover {
            background: white;
            color: black;
            font-size: 1.1em;
        }

        .card-client {
            background: #06a4c7;
            width: 15rem;
            padding-top: 25px;
            padding-bottom: 25px;
            padding-left: 20px;
            padding-right: 20px;
            border: 4px solid #03d1ff;
            box-shadow: 0 6px 10px rgba(207, 212, 222, 1);
            border-radius: 10px;
            text-align: center;
            color: #fff;
            font-family: "Poppins", sans-serif;
            transition: all 0.3s ease;
        }

        .card-client:hover {
            transform: translateY(-10px);
        }

        .user-picture {
            overflow: hidden;
            object-fit: cover;
            width: 5rem;
            height: 5rem;
            border: 4px solid #7cdacc;
            border-radius: 999px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
        }

        .user-picture img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .name-client {
            margin: 0;
            margin-top: 5px;
            font-weight: 600;
            font-size: 18px;
        }

        .name-client span {
            display: block;
            font-weight: 200;
            font-size: 16px;
        }

        .button-message:before {
            content: " ";
            display: block;
            width: 100%;
            height: 2px;
            margin: 20px 0;
            background: #7cdacc;
        }

        .button-message a {
            position: relative;
            margin-right: 15px;
            text-decoration: none;
            color: inherit;
        }

        .button-message a:last-child {
            margin-right: 0;
        }
    </style>
    <div class="container py-5">
        <div class="row">
            <!-- Cột chính chứa thông tin khóa học -->
            <div class="col-md-12">
                <!-- Tên khóa học -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{ $course->course_name }}</h1>
                    </div>
                </div>

                <div class="row m-5">
                    <div class="col-md-12">
                        <img class="img-fluid mb-4 rounded" src="{{ asset('uploads/course_image/' . $course->image) }}"
                            alt="{{ $course->course_name }}" style="width: 100%; height: auto;">
                    </div>
                </div>

                <!-- Phần Course Description và Instructor -->
                <div class="row">
                    <!-- Mô tả khóa học -->
                    <div class="col-md-9">
                        <h3>Course Description</h3>
                        <p>{{ $course->description }}</p>
                        <a href="" class="btn mt-3 enroll-btn">Enroll Now</a>
                    </div>

                    <div class="col-md-3">
                        <div class="card-client">
                            <div class="user-picture">
                                @if (empty($course->user->avatar))
                                    <img src="{{ asset('uploads/avatar/avatar_default.jpg' . $course->user->avatar) }}"
                                        alt="{{ $course->user->fullname }}">
                                @else
                                    <img src="{{ asset('uploads/avatar/' . $course->user->avatar) }}"
                                        alt="{{ $course->user->fullname }}">
                                @endif
                            </div>
                            <p class="name-client">{{ $course->user->fullname }}
                                <span>Instructor</span>
                                <span>{{ $courseCount }} Courses</span>
                            </p>
                            <div class="button-message">
                                <a href=""><button href="" class="btn-send">Send Message</button></a>
                            </div>
                        </div>
                    </div>

                </div>

                <hr>
                <!-- Phần hiển thị các khóa học liên quan -->
                <div class="row mt-5">
                    <div class="col-md-12">
                        <h3>Related Courses</h3>
                        <div class="row">
                            @foreach ($relatedCourses as $relatedCourse)
                                <div id="course" class="col-lg-3 col-md-6 mb-4">
                                    <div class="card h-100 mt-4"
                                        style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s, box-shadow 0.3s;">
                                        <img class="img-fluid card-img-top" src="{{ asset('uploads/course_image/' . $relatedCourse->image) }}" alt="{{ $relatedCourse->course_name }}" title="{{ $relatedCourse->course_name }}">
                                        <div class="card-body text-center">
                                            <p class="card-title text-truncate"
                                                style="max-width: 100%; font-weight: bold; color:#5e5e5e"
                                                title="{{ $relatedCourse->course_name }}">
                                                {{ $relatedCourse->course_name }}
                                            </p>
                                            <div class="d-flex justify-content-center align-items-center mt-3">
                                                @if (empty($relatedCourse->user->avatar))
                                                    <img src="{{ asset('uploads/avatar/avatar_default.jpg') }}"
                                                        alt=""
                                                        style="border-radius: 50%; width: 30px; height: 30px; margin-right: 8px;">
                                                @else
                                                    <img src="{{ asset('uploads/avatar/' . $relatedCourse->user->avatar) }}"
                                                        alt=""
                                                        style="border-radius: 50%; width: 30px; height: 30px; margin-right: 8px;">
                                                @endif
                                                <a href="" class="text-info"
                                                    style="text-decoration: underline;">{{ $relatedCourse->user->fullname }}</a>
                                            </div>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a href="{{ route('courses.detail', $relatedCourse->id) }}">
                                                <button class="readmore-btn">
                                                    <span class="book-wrapper">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="rgb(86, 69, 117)"
                                                            viewBox="0 0 126 75" class="book">
                                                            <rect stroke-width="3" stroke="#fff" rx="7.5"
                                                                height="70" width="121" y="2.5" x="2.5"></rect>
                                                            <line stroke-width="3" stroke="#fff" y2="75"
                                                                x2="63.5" x1="63.5"></line>
                                                            <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                                d="M25 20H50">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                                d="M101 20H76">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                                d="M16 30L50 30"></path>
                                                            <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                                d="M110 30L76 30"></path>
                                                        </svg>

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 65 75" class="book-page">
                                                            <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                                d="M40 20H15">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                                d="M49 30L15 30"></path>
                                                            <path stroke-width="3" stroke="#fff"
                                                                d="M2.5 2.5H55C59.1421 2.5 62.5 5.85786 62.5 10V65C62.5 69.1421 59.1421 72.5 55 72.5H2.5V2.5Z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <span class="text"> Read more </span>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
