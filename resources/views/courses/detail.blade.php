@extends('layouts.userLO')

@section('main')
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
                        <img class="img-fluid mb-4 rounded" src="{{ asset('uploads/course/' . $course->image) }}"
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
                                <!-- Add social media links here if needed -->
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
                                <div class="col-md-3 my-4">
                                    <div class="card h-100 course-card">
                                        <img src="{{ asset('uploads/course/' . $relatedCourse->image) }}"
                                            class="card-img-top" alt="{{ $relatedCourse->course_name }}"
                                            style="height: 150px; object-fit: cover;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title text-truncate text-center" style="max-width: 100%;">
                                                {{ $relatedCourse->course_name }}</h5>
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
                                        <div class="card-footer">
                                            <a href="" class="btn btn-primary btn-block">View Course</a>
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

<style>
    /* Thêm hiệu ứng cho thẻ khóa học */
    .course-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        cursor: pointer;
    }

    .course-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        background-color: #f8f9fa;
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
        cursor: pointer;
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
