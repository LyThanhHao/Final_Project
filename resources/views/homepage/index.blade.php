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

    <!-- About Start -->
    <div class="container-fluid py-4">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="uploads/about.jpg" alt="">
                </div>
                <div class="col-lg-7">
                    <div class="text-left mb-4">
                        <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">About Us</h5>
                        <h1>Innovative Way To Learn</h1>
                    </div>
                    <p>Aliquyam accusam clita nonumy ipsum sit sea clita ipsum clita, ipsum dolores amet voluptua duo
                        dolores et sit ipsum rebum, sadipscing et erat eirmod diam kasd labore clita est. Diam sanctus
                        gubergren sit rebum clita amet, sea est sea vero sed et. Sadipscing labore tempor at sit dolor clita
                        consetetur diam. Diam ut diam tempor no et, lorem dolore invidunt no nonumy stet ea labore, dolor
                        justo et sit gubergren diam sed sed no ipsum. Sit tempor ut nonumy elitr dolores justo aliquyam
                        ipsum stet</p>
                    <a href="" class="btn btn-primary py-md-2 px-md-4 font-weight-semi-bold mt-2">Learn More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Category Start -->
    <div class="container-fluid py-4">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Subjects</h5>
                <h1>Explore Top Subjects</h1>
            </div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="cat-item position-relative overflow-hidden rounded mb-2">
                            <img class="img-fluid" src="{{ asset('uploads/category_image/' . $category->cat_image) }}" alt="" style="width: 100%; height: 150px;">
                            <a class="cat-overlay text-white text-decoration-none" href="{{ route('category.filter', $category->id) }}">
                                <h5 class="text-white font-weight-medium text-center">{{ $category->cat_name }}</h5>
                                <span>{{ $category->courses->where('status', 1)->count() }} Courses</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category Start -->

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
                                @if (!Auth::check() || (Auth::check() && Auth::user()->role != 'Teacher'))
                                    @if ($favorites && $favorites->contains('coursze_id', $course->id))
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
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('uploads/avatar/' . ($course->user->avatar ?? 'avatar_default.jpg')) }}"
                                            alt="" style="border-radius: 10px; width: 25px; height: 25px; margin-right: 6px;">
                                        <span style="font-size: 14px;" class="text-info">{{ $course->user->fullname }}</span>
                                    </div>
                                    <p class="card-title text-truncate"
                                        style="max-width: 100%; font-weight: bold; color:#5e5e5e; margin: 10px 0; text-align: center"
                                        title="{{ $course->course_name }}">
                                        {{ $course->course_name }}
                                    </p>
                                    <span><i class="bi bi-people-fill"></i> {{$course->enrolls()->count()}}</span>
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

    <!-- Registration Start -->
    <div class="container-fluid bg-registration py-4" style="margin: 90px 0;">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Need Any Courses</h5>
                        <h1 class="text-white">30% Off For New Students</h1>
                    </div>
                    <p class="text-white">Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo dolor lorem ipsum
                        ut sed eos,
                        ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est
                        dolor</p>
                    <ul class="list-inline text-white m-0">
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Labore eos amet dolor amet diam
                        </li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Etsea et sit dolor amet ipsum</li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Diam dolor diam elitripsum vero.
                        </li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="card border-0">
                        <div class="card-header bg-light text-center p-4">
                            <h1 class="m-0">Sign Up Now</h1>
                        </div>
                        <div class="card-body rounded-bottom bg-primary p-5">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control border-0 p-4" placeholder="Your name"
                                        required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control border-0 p-4" placeholder="Your email"
                                        required="required" />
                                </div>
                                <div class="form-group">
                                    <select class="custom-select border-0 px-4" style="height: 47px;">
                                        <option selected>Select a course</option>
                                        <option value="1">Course 1</option>
                                        <option value="2">Course 1</option>
                                        <option value="3">Course 1</option>
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-dark btn-block border-0 py-3" type="submit">Sign Up
                                        Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Registration End -->


    <!-- Team Start -->
    <div class="container-fluid py-4">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Teachers</h5>
                <h1>Meet Our Teachers</h1>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 text-center team mb-4">
                    <div class="team-item rounded overflow-hidden mb-2">
                        <div class="team-img position-relative">
                            <img class="img-fluid" src="uploads/avatar/user-1.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="bg-secondary p-4">
                            <h5>Jhon Doe</h5>
                            <p class="m-0">Web Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center team mb-4">
                    <div class="team-item rounded overflow-hidden mb-2">
                        <div class="team-img position-relative">
                            <img class="img-fluid" src="uploads/avatar/user-2.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="bg-secondary p-4">
                            <h5>Jhon Doe</h5>
                            <p class="m-0">Web Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center team mb-4">
                    <div class="team-item rounded overflow-hidden mb-2">
                        <div class="team-img position-relative">
                            <img class="img-fluid" src="uploads/avatar/user-3.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="bg-secondary p-4">
                            <h5>Jhon Doe</h5>
                            <p class="m-0">Web Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 text-center team mb-4">
                    <div class="team-item rounded overflow-hidden mb-2">
                        <div class="team-img position-relative">
                            <img class="img-fluid" src="uploads/avatar/user-4.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-light btn-square mx-1" href="#"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        <div class="bg-secondary p-4">
                            <h5>Jhon Doe</h5>
                            <p class="m-0">Web Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="owl-carousel testimonial-carousel">
                <div class="text-center">
                    <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                    <h4 class="font-weight-normal mb-4">Dolor eirmod diam stet kasd sed. Aliqu rebum est eos. Rebum elitr
                        dolore et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </h4>
                    <img class="img-fluid mx-auto mb-3" src="uploads/testimonial-1.jpg" alt="">
                    <h5 class="m-0">Client Name</h5>
                    <span>Profession</span>
                </div>
                <div class="text-center">
                    <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                    <h4 class="font-weight-normal mb-4">Dolor eirmod diam stet kasd sed. Aliqu rebum est eos. Rebum elitr
                        dolore et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </h4>
                    <img class="img-fluid mx-auto mb-3" src="uploads/testimonial-2.jpg" alt="">
                    <h5 class="m-0">Client Name</h5>
                    <span>Profession</span>
                </div>
                <div class="text-center">
                    <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                    <h4 class="font-weight-normal mb-4">Dolor eirmod diam stet kasd sed. Aliqu rebum est eos. Rebum elitr
                        dolore et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </h4>
                    <img class="img-fluid mx-auto mb-3" src="uploads/testimonial-3.jpg" alt="">
                    <h5 class="m-0">Client Name</h5>
                    <span>Profession</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

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
