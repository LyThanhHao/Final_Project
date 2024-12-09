    @extends('layouts/userLO')

    @section('main')
    <style>
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

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
            letter-spacing: 3px;
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

        .view-btn {
            border: none;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 3px;
            text-transform: uppercase;
            cursor: pointer;
            color: #2caf37;
            transition: all 1000ms;
            font-size: 8px;
            position: relative;
            overflow: hidden;
            outline: 2px solid #2caf37;
            line-height: 2;
            font-size: 13px;
        }

        .view-btn:hover {
            color: #ffffff;
            transform: scale(1.1);
            outline: 2px solid #70ca77;
            box-shadow: 4px 5px 17px -4px #639126;
        }

        .view-btn::before {
            content: "";
            position: absolute;
            left: -50px;
            top: 0;
            width: 0;
            height: 100%;
            background-color: #2caf37;
            transform: skewX(45deg);
            z-index: -1;
            transition: width 1000ms;
        }

        .view-btn:hover::before {
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
            border: none;
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

        .button-message a {
            position: relative;
            margin-right: 15px;
            text-decoration: none;
            color: inherit;
        }

        .button-message a:last-child {
            margin-right: 0;
        }

        .btn-comment {
            background-color: #0088cc;
            color: #6c757d;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-comment:hover {
            transform: scale(1.1);
            color: #ffffff;
            background: #008cff;
            border: 1px solid #008cff;
            text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 20px #ffffff;
            box-shadow: 0 0 5px #008cff, 0 0 20px #008cff, 0 0 50px #008cff,
                0 0 100px #008cff;
        }

        .btn-comment i {
            color: snow;
        }

        .btn-comment:hover i {
            color: #ffffff;
        }

        .card-comment {
            border: 1px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .btn-light {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 50%;
            padding: 10px;
            font-size: 18px;
            color: #6c757d;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-light:hover {
            background-color: #e2e6ea;
            transform: scale(1.1);
        }

        .comment-box .user-info {
            display: flex;
            align-items: center;
        }

        .comment-box .user-info img {
            border-radius: 50%;
            width: 30;
            height: 30;
            margin-right: 10px;
        }

        .comment-box .user-info .user-name {
            font-weight: bold;
            font-size: 15px;
            text-decoration: underline;
        }

        .comment-box .comment-content {
            font-size: 14px;
            color: #6c757d;
        }

        /* From Uiverse.io by G4b413l */
        .group {
            position: relative;
        }

        .input {
            font-size: 16px;
            padding: 10px 10px 10px 5px;
            display: block;
            width: 100%;
            border: none;
            border-bottom: 1px solid #515151;
            background: transparent;
        }

        .input:focus {
            outline: none;
        }

        label {
            color: #999;
            font-size: 15px;
            font-weight: normal;
            position: absolute;
            pointer-events: none;
            left: 5px;
            top: 10px;
            transition: 0.2s ease all;
            -moz-transition: 0.2s ease all;
            -webkit-transition: 0.2s ease all;
        }

        .input:focus~label,
        .input:valid~label {
            top: -20px;
            font-size: 14px;
            color: #5264AE;
        }

        .bar {
            position: relative;
            display: block;
            width: 100%;
        }

        .bar:before,
        .bar:after {
            content: '';
            height: 2px;
            width: 0;
            bottom: 1px;
            position: absolute;
            background: #5264AE;
            transition: 0.2s ease all;
            -moz-transition: 0.2s ease all;
            -webkit-transition: 0.2s ease all;
        }

        .bar:before {
            left: 50%;
        }

        .bar:after {
            right: 50%;
        }

        .input:focus~.bar:before,
        .input:focus~.bar:after {
            width: 50%;
        }

        .highlight {
            position: absolute;
            height: 60%;
            width: 100px;
            top: 25%;
            left: 0;
            pointer-events: none;
            opacity: 0.5;
        }

        .input:focus~.highlight {
            animation: inputHighlighter 0.3s ease;
        }

        @keyframes inputHighlighter {
            from {
                background: #5264AE;
            }

            to {
                width: 0;
                background: transparent;
            }
        }

        .btn-save {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            width: 40px;
            height: 40px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition-duration: 0.4s;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to right, #34c5db, #2645f1);
        }

        .sign {
            width: 100%;
            transition-duration: 0.4s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sign i {
            width: 17px;
            fill: white;
            color: white;
        }

        .text-save {
            position: absolute;
            right: 0%;
            width: 0%;
            opacity: 0;
            color: #ecf0f1;
            font-size: 1em;
            font-weight: 600;
            transition-duration: 0.4s;
        }

        .btn-save:hover {
            width: 100px;
            border-radius: 20px;
            transition-duration: 0.4s;
            background: linear-gradient(to right, #34c5db, #2645f1);
        }

        .btn-save:hover .sign {
            width: 30%;
            transition-duration: 0.4s;
        }

        .btn-save:hover .text-save {
            opacity: 1;
            width: 70%;
            transition-duration: 0.4s;
            padding-right: 10px;
        }

        .btn-save:active {
            transform: translate(2px, 2px);
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.2);
        }

        .comment-box {
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
            margin-bottom: 15px;
        }

        .comment-content {
            font-size: 0.9em;
        }

        .btn-options {
            background-color: transparent;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .options-menu {
            width: max-content;
            display: none;
            background: white;
            border: 1px solid #ccc;
            z-index: 1;
        }

        .options-menu button {
            background: none;
            border: 1px solid #ccc;
            color: black;
            cursor: pointer;
            width: max-content;
            text-align: left;
        }

        .options-menu:hover {
            color: white;
        }

        .options-menu #btn-update-comment {
            color: blue;
            cursor: pointer;
            padding: 5px;
            width: -webkit-fill-available;
            text-align: left;
            font-weight: bold;
        }

        .options-menu #btn-delete-comment {
            color: red;
            cursor: pointer;
            padding: 5px;
            width: -webkit-fill-available;
            text-align: left;
            font-weight: bold;
        }

        .options-menu #btn-update-comment:hover,
        #btn-delete-comment:hover {
            background-color: #515151;
            color: white;
        }

        .edit-form {
            display: none;
            margin-top: 10px;
        }

        .edit-comment-input {
            width: 100%;
            padding: 5px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        .btn-cancel,
        .btn-save-comment {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
        }

        .btn-cancel {
            background-color: #dc3545;
        }

        .btn-cancel:hover,
        .btn-save-comment:hover {
            opacity: 0.8;
        }

        .teacher_profile:hover {
            text-decoration: underline;
            text-decoration-color: #17a2b8;
        }

        .bookmark-icon {
            top: 10px;
            right: 10px;
            font-size: 24px;
            color: rgb(0 90 255);
            cursor: pointer;
            text-shadow: 0 0 5px #ffffff, 0 0 10px #ffffff, 0 0 20px #008cff;
        }

        .bookmark-icon:hover {
            transition: 0.5s;
            transform: scale(1.2);
            color: #ffffff;
            text-shadow: 0 0 5px #ffffff, 0 0 10px #008cff, 0 0 20px #008cff;
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
                        <hr style="width: 300px; margin-left: 0">
                        <div class="d-flex">
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST"
                                style="display: inline;">
                                @if (!Auth::check() || (Auth::check() && Auth::user()->role != 'Teacher'))
                                    @if ($enrolled)
                                        <div><a href="{{ route('courses.view', $course->id) }}"
                                                class="btn view-btn mb-3 mr-4 px-4">Go To Course</a></div>
                                    @else
                                        @csrf
                                        <div><button type="submit" class="btn enroll-btn mr-4 mb-3">Enroll Now</button>
                                        </div>
                                    @endif
                                    <span><strong>{{ $enrollCount }}</strong> already enrolled</span>
                                @endif
                            </form>
                            @if (!Auth::check() || (Auth::check() && Auth::user()->role != 'Teacher'))
                                <div>
                                    @if (!$favorite)
                                        <button class="btn-save" id="save-course" data-course-id="{{ $course->id }}"
                                            title="Save this course to your favorite list">
                                            <div class="sign">
                                                <i class="bi bi-bookmark"></i>
                                            </div>
                                            <div class="text-save" title="Save this course to your favorite list">Save
                                            </div>
                                        </button>
                                    @else
                                        <button class="btn-save" id="save-course" data-course-id="{{ $course->id }}"
                                            title="Course has been saved to your favorite list">
                                            <div class="sign">
                                                <i class="bi bi-bookmark-fill"></i>
                                            </div>
                                            <div class="text-save">Saved</div>
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-client">
                            <div class="user-picture">
                                <img src="{{ asset('uploads/avatar/' . ($course->user->avatar ?? 'avatar_default.jpg')) }}"
                                    alt="{{ $course->user->fullname }}">
                            </div>
                            <p class="name-client">{{ $course->user->fullname }}
                                <span style="font-style: italic; margin-bottom: 15px;">Teacher</span>
                                <span style="color: greenyellow">{{ $courseCount }} Courses</span>
                            </p>
                            <hr style="display: block; width: 100%; height: 2px; margin: 20px 0; background: #7cdacc;">
                            <div class="button-message">
                                <a href="{{ route('teacher_profile', $course->user->id) }}"><button
                                        href="" class="btn-send">View Profile</button></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5" style="border: 1px solid #e9ecef; border-radius: 10px;">
                    <div class="col-md-12" style="padding: 10px;">
                        <div class="card-comment p-3">
                            <h3 class="text-center">Send Comment</h3>
                            <form id="comment-form" method="POST" action="{{ route('comments.store') }}">
                                @csrf
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('uploads/avatar/' . ($user->avatar ?? 'avatar_default.jpg')) }}"
                                        alt="{{ $user->fullname ?? 'User' }}" class="rounded-circle" width="30"
                                        height="30">
                                    <div class="group flex-grow-1 mr-2">
                                        <input type="hidden" name="course_id" value="{{ $course->id }}" required>
                                        <input required type="text" name="content" class="input" id="content">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Write comment</label>
                                    </div>
                                    <button type="submit" class="btn btn-comment"><i
                                            class="fas fa-paper-plane"></i></button>
                                </div>
                            </form>
                        </div>
                        {{-- <hr style="width: 75%; display: flex; align-items: center;"> --}}
                        <div id="comments-list" class="mt-4">
                            @foreach ($course->comments as $comment)
                                <div class="comment-box px-3" data-comment-id="{{ $comment->id }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="user-info d-flex align-items-center">
                                            <img src="{{ asset('uploads/avatar/' . ($comment->user->avatar ?? 'avatar_default.jpg')) }}"
                                                alt="{{ $comment->user->fullname }}" class="rounded-circle"
                                                width="30" height="30">
                                            <div>
                                                <div class="user-name">{{ $comment->user->fullname }}</div>
                                                <div class="comment-content" style="font-size: 0.9em;">
                                                    {{ $comment->content }}</div>
                                            </div>
                                        </div>
                                        @if(Auth::check() && Auth::id() == $comment->user_id)
                                            <div class="options" style="position: relative;">
                                                <button class="btn-options" onclick="toggleOptions(this)">...</button>
                                                <div class="options-menu" style="display: none;">
                                                    <button id="btn-update-comment" onclick="updateComment({{ $comment->id }})">
                                                        <i style="color: blue; margin: 0 5px; font-weight: bold;" class="bi bi-pen"></i>Update
                                                    </button>
                                                    <br>
                                                    <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" id="btn-delete-comment" onclick="confirmDelete(event, this)">
                                                            <i style="color: red; margin: 0 5px;" class="bi bi-trash"></i>Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('comments.update', $comment->id) }}"
                                        style="display: none; width: 100%;" class="edit-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="group flex-grow-1 mr-2">
                                            <input type="text" name="content" class="input edit-comment-input"
                                                value="{{ $comment->content }}">
                                            <span class="highlight"></span>
                                            <span class="bar"></span>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" class="btn-cancel"
                                                onclick="cancelEdit(this)">Cancel</button>
                                            <button type="submit" class="btn-save-comment">Save</button>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Phần hiển thị các khóa học liên quan -->
                <div class="row mt-5">
                    <div class="col-md-12">
                        <h3>Related Courses</h3>
                        <div class="row">
                            @foreach ($relatedCourses as $relatedCourse)
                                @if ($relatedCourse->status && $relatedCourse->category->status)
                                    <div id="course" class="col-lg-3 col-md-6 mt-3">
                                        <div class="card h-100"
                                            style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s, box-shadow 0.3s;">
                                            <img style="height: 45%;" class="img-fluid card-img-top"
                                                src="{{ asset('uploads/course_image/' . $relatedCourse->image) }}"
                                                alt="{{ $relatedCourse->course_name }}"
                                                title="{{ $relatedCourse->course_name }}">
                                            @if (!Auth::check() || (Auth::check() && Auth::user()->role != 'Teacher'))
                                                @if ($favorite)
                                                    <div class="bookmark-icon position-absolute">
                                                        <i class="bi bi-bookmark-dash-fill"
                                                            data-course-id="{{ $relatedCourse->id }}"
                                                            title="Remove from favorite list"></i>
                                                    </div>
                                                @else
                                                    <div class="bookmark-icon position-absolute">
                                                        <i class="bi bi-bookmark-plus-fill"
                                                            data-course-id="{{ $relatedCourse->id }}"
                                                            title="Add to favorite list"></i>
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('uploads/avatar/' . ($relatedCourse->user->avatar ?? 'avatar_default.jpg')) }}"
                                                        alt=""
                                                        style="border-radius: 50%; width: 30px; height: 30px; margin-right: 6px;">
                                                    <a href="{{ route('teacher_profile', $relatedCourse->user->id) }}"
                                                        class="teacher_profile"><b class="text-info"
                                                            style="font-weight: 400; font-size: 14px;">{{ $relatedCourse->user->fullname }}</b></a>
                                                </div>
                                                <p class="card-title text-truncate"
                                                    style="max-width: 100%; font-weight: bold; color:#5e5e5e; margin: 10px 0; text-align: center"
                                                    title="{{ $relatedCourse->course_name }}">
                                                    {{ $relatedCourse->course_name }}
                                                </p>
                                                <span><i class="bi bi-people-fill"></i>
                                                    {{ $relatedCourse->enrolls()->count() }}</span>
                                            </div>
                                            <div class="card-footer text-center">
                                                <a href="{{ route('courses.detail', $relatedCourse->id) }}">
                                                    <button class="readmore-btn">
                                                        <span class="book-wrapper">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                fill="rgb(86, 69, 117)" viewBox="0 0 126 75"
                                                                class="book">
                                                                <rect stroke-width="3" stroke="#fff" rx="7.5"
                                                                    height="70" width="121" y="2.5" x="2.5">
                                                                </rect>
                                                                <line stroke-width="3" stroke="#fff" y2="75"
                                                                    x2="63.5" x1="63.5"></line>
                                                                <path stroke-linecap="round" stroke-width="4"
                                                                    stroke="#fff" d="M25 20H50">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-width="4"
                                                                    stroke="#fff" d="M101 20H76">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-width="4"
                                                                    stroke="#fff" d="M16 30L50 30"></path>
                                                                <path stroke-linecap="round" stroke-width="4"
                                                                    stroke="#fff" d="M110 30L76 30"></path>
                                                            </svg>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 65 75" class="book-page">
                                                                <path stroke-linecap="round" stroke-width="4"
                                                                    stroke="#fff" d="M40 20H15">
                                                                </path>
                                                                <path stroke-linecap="round" stroke-width="4"
                                                                    stroke="#fff" d="M49 30L15 30"></path>
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
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cuộn đến bình luận mới
            @if (session('new_comment_id'))
                const newCommentId = {{ session('new_comment_id') }};
                const newCommentElement = document.querySelector(`.comment-box[data-comment-id='${newCommentId}']`);
                if (newCommentElement) {
                    newCommentElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            @endif

            // Cuộn đến bình luận đã cập nhật
            @if (session('updated_comment_id'))
                const updatedCommentId = {{ session('updated_comment_id') }};
                const updatedCommentElement = document.querySelector(
                    `.comment-box[data-comment-id='${updatedCommentId}']`);
                if (updatedCommentElement) {
                    updatedCommentElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            @endif

            // Cuộn đến vị trí của bình luận đã xóa
            @if (session('deleted_comment_id'))
                const deletedCommentId = {{ session('deleted_comment_id') }};
                const deletedCommentElement = document.querySelector(
                    `.comment-box[data-comment-id='${deletedCommentId}']`);
                if (deletedCommentElement) {
                    deletedCommentElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            @endif
        });

        function toggleOptions(button) {
            const menu = button.nextElementSibling;
            const isVisible = menu.style.display === 'block';

            // Ẩn tất cả các menu khác
            document.querySelectorAll('.options-menu').forEach(m => m.style.display = 'none');

            if (!isVisible) {
                // Hiển thị menu tại vị trí của nút ba chấm
                const rect = button.getBoundingClientRect();
                menu.style.display = 'block';
                menu.style.position = 'absolute';
            }
        }

        function updateComment(commentId) {
            if (!{{ Auth::check() ? 'true' : 'false' }}) {
                window.location.href = '{{ route('homepage.login') }}';
                return;
            }
            const commentBox = document.querySelector(`.comment-box[data-comment-id='${commentId}']`);
            const commentContent = commentBox.querySelector('.comment-content');
            const editForm = commentBox.querySelector('.edit-form');
            const btnOptions = commentBox.querySelector('.btn-options');
            const optionsMenu = commentBox.querySelector('.options-menu');
            const editInput = editForm.querySelector('.edit-comment-input');

            // Ẩn nội dung hiện tại và hiển thị form để chỉnh sửa
            commentContent.style.display = 'none';
            editForm.style.display = 'block';
            btnOptions.style.display = 'none'; // Ẩn dấu ba chấm
            optionsMenu.style.display = 'none'; // Ẩn menu tùy chọn

            // Focus vào input
            editInput.focus();
            editInput.setSelectionRange(editInput.value.length, editInput.value.length);
        }

        function cancelEdit(button) {
            const commentBox = button.closest('.comment-box');
            const commentContent = commentBox.querySelector('.comment-content');
            const editForm = commentBox.querySelector('.edit-form');
            const btnOptions = commentBox.querySelector('.btn-options');

            commentContent.style.display = 'block';
            editForm.style.display = 'none';
            btnOptions.style.display = 'inline-block'; // Hiển thị lại dấu ba chấm
        }

        document.addEventListener('click', function(event) {
            const optionsMenus = document.querySelectorAll('.options-menu');
            optionsMenus.forEach(menu => {
                if (!menu.contains(event.target) && !menu.previousElementSibling.contains(event.target)) {
                    menu.style.display = 'none';
                }
            });
        });

        function confirmDelete(event, button) {
            if (!{{ Auth::check() ? 'true' : 'false' }}) {
                window.location.href = '{{ route('homepage.login') }}';
                return;
            }
            event.preventDefault();
            const form = button.closest('form');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // Bookmark event handler
            $('.bookmark-icon i').on('click', function() {
                const courseId = $(this).data('course-id');
                const isSaved = $(this).hasClass('bi-bookmark-dash-fill'); // Check current state

                // Determine the correct AJAX method and URL based on the current state
                const method = isSaved ? 'DELETE' : 'POST';
                const url = `/courses/${courseId}/favorite`;

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (isSaved) {
                            $.toast({
                                heading: 'Notification',
                                text: 'Course removed from favorites',
                                showHideTransition: 'slide',
                                position: 'top-center',
                                icon: 'success',
                                hideAfter: 5000
                            });
                            // Update the icon and title
                            $(`i[data-course-id="${courseId}"]`).removeClass(
                                    'bi-bookmark-dash-fill').addClass('bi-bookmark-plus-fill')
                                .attr('title', 'Add to favorite list');
                        } else {
                            $.toast({
                                heading: 'Notification',
                                text: 'Course added to favorites',
                                showHideTransition: 'slide',
                                position: 'top-center',
                                icon: 'success',
                                hideAfter: 5000
                            });
                            // Update the icon and title
                            $(`i[data-course-id="${courseId}"]`).removeClass(
                                    'bi-bookmark-plus-fill').addClass('bi-bookmark-dash-fill')
                                .attr('title', 'Remove from favorite list');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        if (jqXHR.status === 401) {
                            window.location.href = '{{ route('homepage.login') }}';
                        } else {
                            console.log('Something went wrong!', jqXHR.responseText);
                            $.toast({
                                heading: 'Notification',
                                text: 'An error occurred while processing your request',
                                showHideTransition: 'slide',
                                position: 'top-center',
                                icon: 'error',
                                hideAfter: 5000
                            });
                        }
                    }
                });
            });
        });
    </script>
    @endsection
