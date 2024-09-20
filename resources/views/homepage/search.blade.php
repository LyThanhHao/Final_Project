@extends('layouts/userLO')

@section('main')
    <div class="container">
        <h2 class="text-center my-5">Search results for "{{ $keyword }}"</h2>

        @if ($courses->isEmpty())
            <div class="mx-auto">
                <hr class="mb-5" style="width: 400px;">
                <p style="text-align: center; font-size: 20px; font-weight: bold; color: red;">No courses found!</p>
            </div>
        @else
            <div class="row">
                @foreach ($courses as $course)
                    <div id="course" class="col-lg-3 col-md-6 mb-4">
                        <div class="card h-100 position-relative"
                            style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s, box-shadow 0.3s;;"
                            title="{{ $course->course_name }}">
                            <img style="height: 45%;" class="img-fluid card-img-top"
                                src="{{ asset('uploads/course_image/' . $course->image) }}"
                                alt="{{ $course->course_name }}">
                            @if (!Auth::check() || (Auth::check() && Auth::user()->role != 'Teacher'))
                                @if ($favorites && $favorites->contains('course_id', $course->id))
                                    <div class="bookmark-icon position-absolute">
                                        <i class="bi bi-bookmark-dash-fill" data-course-id="{{ $course->id }}"
                                            title="Remove from favorite list"></i>
                                    </div>
                                @else
                                    <div class="bookmark-icon position-absolute">
                                        <i class="bi bi-bookmark-plus-fill" data-course-id="{{ $course->id }}"
                                            title="Add to favorite list"></i>
                                    </div>
                                @endif
                            @endif
                            <div class="card-body text-center">
                                <p class="card-title text-truncate"
                                    style="max-width: 100%; font-weight: bold; color:#5e5e5e"
                                    title="{{ $course->course_name }}">
                                    {{ $course->course_name }}
                                </p>
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                    @if (empty($course->user->avatar))
                                        <img src="{{ asset('uploads/avatar/avatar_default.jpg') }}" alt=""
                                            style="border-radius: 50%; width: 30px; height: 30px; margin-right: 8px;">
                                    @else
                                        <img src="{{ asset('uploads/avatar/' . $course->user->avatar) }}" alt=""
                                            style="border-radius: 50%; width: 30px; height: 30px; margin-right: 8px;">
                                    @endif
                                    <a href="" class="text-info"
                                        style="text-decoration: underline; font-weight: bold;">{{ $course->user->fullname }}</a>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('courses.detail', $course->id) }}">
                                    <button class="readmore-btn">
                                        <span class="book-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="rgb(86, 69, 117)"
                                                viewBox="0 0 126 75" class="book">
                                                <rect stroke-width="3" stroke="#fff" rx="7.5" height="70"
                                                    width="121" y="2.5" x="2.5"></rect>
                                                <line stroke-width="3" stroke="#fff" y2="75" x2="63.5"
                                                    x1="63.5"></line>
                                                <path stroke-linecap="round" stroke-width="4" stroke="#fff" d="M25 20H50">
                                                </path>
                                                <path stroke-linecap="round" stroke-width="4" stroke="#fff" d="M101 20H76">
                                                </path>
                                                <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                    d="M16 30L50 30"></path>
                                                <path stroke-linecap="round" stroke-width="4" stroke="#fff"
                                                    d="M110 30L76 30"></path>
                                            </svg>

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 65 75"
                                                class="book-page">
                                                <path stroke-linecap="round" stroke-width="4" stroke="#fff" d="M40 20H15">
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
        @endif
    </div>

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
