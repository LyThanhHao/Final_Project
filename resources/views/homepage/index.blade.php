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
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#header-carousel" data-slide-to="1"></li>
                <li data-target="#header-carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active" style="min-height: 300px;">
                    <img class="position-relative w-100" src="uploads/carousel-1.jpg"
                        style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Best Online Courses</h5>
                            <h1 class="display-3 text-white mb-md-4">Best Education From Your Home</h1>
                            <a href="" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn
                                More</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="uploads/carousel-2.jpg"
                        style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Best Online Courses</h5>
                            <h1 class="display-3 text-white mb-md-4">Best Online Learning Platform</h1>
                            <a href="" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn
                                More</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" style="min-height: 300px;">
                    <img class="position-relative w-100" src="uploads/carousel-3.jpg"
                        style="min-height: 300px; object-fit: cover;">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="p-5" style="width: 100%; max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-md-3">Best Online Courses</h5>
                            <h1 class="display-3 text-white mb-md-4">New Way To Learn From Home</h1>
                            <a href="" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn
                                More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- New Courses Start -->
    <div class="container-fluid">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3 text-bold" style="letter-spacing: 5px;">Courses</h5>
                <h1>New Courses</h1>
            </div>
            <div class="row">
                @foreach ($courses as $course)
                    @if ($course->status && $course->category->status)
                        <div id="course" class="col-lg-3 col-md-6 mb-4">
                            <div class="card h-100 position-relative"
                                style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: transform 0.3s, box-shadow 0.3s;"
                                title="{{ $course->course_name }}">
                                <img class="img-fluid card-img-top" style="height: 45%;"
                                    src="{{ asset('uploads/course_image/' . $course->image) }}"
                                    alt="{{ $course->course_name }}">
                                @if (Auth::check())
                                    @if (Auth::user()->favorites->contains($course->id))
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
                                        <img src="{{ empty($course->user->avatar) ? asset('uploads/avatar/avatar_default.jpg') : asset('uploads/avatar/' . $course->user->avatar) }}"
                                            alt=""
                                            style="border-radius: 50%; width: 30px; height: 30px; margin-right: 8px;">
                                        <a href="" class="text-info font-weight-bold"
                                            style="text-decoration: underline;"
                                            title="{{ $course->user->fullname }}">{{ $course->user->fullname }}</a>
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
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- New Courses End -->

    <!-- JavaScript Libraries -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        document.querySelectorAll('.bookmark-icon i').forEach(icon => {
            icon.addEventListener('click', function() {
                const courseId = this.getAttribute('data-course-id');
                const isAdding = this.classList.contains('bi-bookmark-plus-fill');
                const method = isAdding ? 'POST' : 'DELETE';
                const url = `/courses/${courseId}/favorite`;

                fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (isAdding) {
                                $.toast({
                                    heading: 'Notification',
                                    text: 'Course added to favorites',
                                    showHideTransition: 'slide',
                                    position: 'top-center',
                                    icon: 'success',
                                    hideAfter: 5000
                                });
                                this.classList.remove('bi-bookmark-plus-fill');
                                this.classList.add('bi-bookmark-dash-fill');
                                this.setAttribute('title', 'Remove from favorite list');
                            } else {
                                $.toast({
                                    heading: 'Notification',
                                    text: 'Course removed from favorites',
                                    showHideTransition: 'slide',
                                    position: 'top-center',
                                    icon: 'success',
                                    hideAfter: 5000
                                });
                                this.classList.remove('bi-bookmark-dash-fill');
                                this.classList.add('bi-bookmark-plus-fill');
                                this.setAttribute('title', 'Add to favorite list');
                            }
                        } else {
                            $.toast({
                                heading: 'Notification',
                                text: isAdding ? 'Failed to add course to favorites' :
                                    'Failed to remove course from favorites',
                                showHideTransition: 'slide',
                                position: 'top-center',
                                icon: 'error',
                                hideAfter: 5000
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        $.toast({
                            heading: 'Notification',
                            text: 'An error occurred while processing your request',
                            showHideTransition: 'slide',
                            position: 'top-center',
                            icon: 'error',
                            hideAfter: 5000
                        });
                    });
            });
        });
    </script>
@endsection
