<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ECOURSES</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
</head>

<style>
    .back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        font-size: 24px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .back-to-top:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center py-4 px-xl-5 justify-content-around">
            <div class="col-lg-3">
                <a href="{{ route('homepage') }}" class="text-decoration-none">
                    <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
                </a>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    <form class="d-flex" method="GET" action="{{ route('homepage.search') }}">
                        <input class="form-control me-2 search-input" type="search" name="keyword"
                            placeholder="Search...." aria-label="Search">
                        <button class="btn search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 text-right">
                <div class="d-inline-flex align-items-center">
                    @if (Auth::check())
                        <div class="menu">
                            <div class="item">
                                <div class="link">
                                    <span style="font-weight: 500;">Hello</span>
                                    <span>{{ Auth::user()->fullname }}</span>
                                    <i class="bi bi-chevron-down text-bold"></i>
                                </div>
                                <div class="submenu">
                                    <div class="submenu-item">
                                        <a href="{{ route('profile') }}" class="submenu-link">
                                            <i class="bi bi-person-circle"></i>
                                            Profile
                                        </a>
                                    </div>
                                    @if (Auth::user()->role == 'Admin')
                                        <div class="submenu-item d-flex align-items-center">
                                            <a href="{{ route('admin') }}" class="submenu-link font-weight-bold"
                                                id="role">
                                                <i class="bi bi-person-fill-gear"></i>
                                                Admin
                                            </a>
                                        </div>
                                    @elseif (Auth::user()->role == 'Teacher')
                                        <div class="submenu-item">
                                            <a href="{{ route('teacher') }}" class="submenu-link font-weight-bold"
                                                id="role">
                                                Teacher Dashboard
                                            </a>
                                        </div>
                                    @endif
                                    <div class="submenu-item">
                                        <a href="{{ route('homepage.logout') }}" class="submenu-link">
                                            <i class="bi bi-box-arrow-right"></i>
                                            Log out
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a class="btn-login py-2 px-4 ml-auto d-none d-lg-block"
                            href="{{ route('homepage.login') }}">Log in</a>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5" style="border-bottom: 1px solid silver;">
            <div class="col-lg-3 d-none d-lg-block" id="dropdownSub">
                <a class="d-flex align-items-center justify-content-between bg-secondary w-100 text-decoration-none"
                    href="javascript:void(0);" style="height: 67px; padding: 0 30px;">
                    <h5 class="text-primary m-0"><i class="fa fa-bookcat_home-open mr-2 text-bold"></i>Categories</h5>
                    <i class="fa fa-angle-down text-primary"></i>
                </a>
                <nav class="navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light"
                    id="navbar-vertical" style="z-index: 9;">
                    <div class="navbar-nav w-100">
                        @foreach ($cat_home as $category)
                            <a href="{{ route('category.filter', $category->id) }}" id="dropdown-item"
                                class="nav-item nav-link"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align: center;"
                                title="{{ $category->cat_name }}">{{ $category->cat_name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="{{ route('homepage') }}" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <ul class="navbar-nav mt-0">
                            <li class="nav-item d-lg-none">
                                <div class="col-lg-3 text-right">
                                    <div class="d-inline-flex align-items-center">
                                        <form class="d-flex" method="GET" action="{{ route('homepage.search') }}">
                                            <input class="form-control me-2 search-input" type="search"
                                                name="keyword" placeholder="Search...." aria-label="Search">
                                            <button class="btn search-btn" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item d-lg-none">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" style="font-weight: bold;"
                                        data-bs-toggle="dropdown">Categories</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <div class="navbar-nav w-100">
                                            @foreach ($cat_home as $category)
                                                <a href="{{ route('category.filter', $category->id) }}"
                                                    id="dropdown-item" class="nav-item nav-link"
                                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align: center;"
                                                    title="{{ $category->cat_name }}">{{ $category->cat_name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('homepage') }}" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('homepage.about_us') }}" class="nav-link">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('homepage.contact') }}" class="nav-link">Contact</a>
                            </li>
                            @if (Auth::check() && (Auth::user()->role == 'Student' || Auth::user()->role == 'Admin'))
                                <li class="nav-item">
                                    <a href="{{ route('favorite_list') }}" class="nav-link">Favorites List</a>
                                </li>
                                <li class="nav-item">
                                    <button id="myCoursesButton" class="nav-link"
                                        style="border: none; background-color: unset;">My Courses</button>
                                    <div id="coursesPopup" class="popup" style="display: none;">
                                        <div class="popup-header d-flex justify-content-between align-items-center">
                                            <span style="font-weight: 600; color: #333; font-size: 18px;">My
                                                Courses</span>
                                            <a href="{{ route('my_courses') }}" class="view-all">View all</a>
                                        </div>
                                        <hr style="width: 75%;">
                                        <ul id="coursesList" class="courses-list">
                                            <!-- The course will be displayed here -->
                                        </ul>
                                    </div>
                                </li>
                            @elseif (Auth::check() && Auth::user()->role == 'Teacher')
                                <li class="nav-item">
                                    <a href="{{ route('teacher') }}" class="nav-link">Teacher Dashboard</a>
                                </li>
                            @endif
                            <li class="nav-item d-lg-none">
                                <div class="col-lg-3 text-right">
                                    <div class="d-inline-flex align-items-center">
                                        @if (Auth::check())
                                            <div class="menu">
                                                <div class="item">
                                                    <div class="link">
                                                        <span style="font-weight: 500;">Hello</span>
                                                        <span>{{ Auth::user()->fullname }}</span>
                                                        <i class="bi bi-chevron-down text-bold"></i>
                                                    </div>
                                                    <div class="submenu">
                                                        <div class="submenu-item">
                                                            <a href="{{ route('profile') }}"
                                                                class="submenu-link">Profile</a>
                                                        </div>
                                                        @if (Auth::user()->role == 'Admin')
                                                            <div class="submenu-item">
                                                                <a href="{{ route('admin') }}"
                                                                    class="submenu-link font-weight-bold"
                                                                    id="role">Admin</a>
                                                            </div>
                                                        @elseif (Auth::user()->role == 'Teacher')
                                                            <div class="submenu-item">
                                                                <a href="{{ route('teacher') }}"
                                                                    class="submenu-link font-weight-bold"
                                                                    id="role">Teacher Dashboard</a>
                                                            </div>
                                                        @endif
                                                        <div class="submenu-item">
                                                            <a href="{{ route('homepage.logout') }}"
                                                                class="submenu-link">Log out </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a class="btn-login py-2 px-4 ml-auto d-lg-none d-lg-block"
                                                href="{{ route('homepage.login') }}">Log in</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Main content -->
    @yield('main')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-square" href="#"><i
                                    class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Our Subjects</h5>
                        <div class="d-flex flex-column justify-content-start">
                            @foreach ($cat_home as $temp)
                                <a class="text-white mb-2" href="{{ route('category.filter', $temp->id) }}"><i
                                        class="fa fa-angle-right mr-2"></i>{{ $temp->cat_name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 mb-5">
                <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Newsletter</h5>
                <p>Rebum labore lorem dolores kasd est, et ipsum amet et at kasd, ipsum sea tempor magna tempor. Accu
                    kasd sed ea duo ipsum. Dolor duo eirmod sea justo no lorem est diam</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;"
                            placeholder="Your Email Address">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5"
        style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">E-Courses</a>. All Rights Reserved. Designed by
                    <a href="https://www.facebook.com/l.hazo3/">Ly Thanh Hao</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <button id="scrollToTopBtn" class="back-to-top" style="display: none;">↑</button>

    <!-- JavaScript Libraries -->

    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- toast notification -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    @if (Session::has('fail'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('fail') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'error',
                hideAfter: 5000
            })
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            $.toast({
                heading: 'Notification',
                text: "{{ Session::get('success') }}",
                showHideTransition: 'slide',
                position: 'top-center',
                icon: 'success',
                hideAfter: 5000
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#myCoursesButton').on('click', function() {

                $.ajax({
                    url: '{{ route('courses.enrolled') }}',
                    method: 'GET',
                    success: function(data) {
                        $('#coursesList').empty();

                        // Kiểm tra nếu danh sách trống
                        if (data.length === 0) {
                            // Hiển thị thông báo nếu danh sách trống
                            $('#coursesList').append(`
                        <li class="no-courses" style="color: red; font-size: 15px; text-align: center; font-weight: 500;">
                            You have not enrolled in any courses yet
                        </li>`);
                            // Làm cho nút "View all" không nhấn được
                            $('.view-all').addClass('disabled-link').css('pointer-events',
                                'none').css('color', 'gray');
                        } else {
                            // Hiển thị danh sách khóa học nếu có
                            data.forEach(course => {
                                const imagePath =
                                    `{{ asset('uploads/course_image') }}/${course.image}`;
                                const url = `{{ url('courses/view') }}/${course.id}`;

                                $('#coursesList').append(`
                            <li class="course-item">
                                <a href="${url}" class="d-flex align-items-center">
                                    <div class="course-image">
                                        <img src="${imagePath}" alt="${course.course_name}">
                                    </div>
                                    <div class="course-info">
                                        <h4 class="course-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            ${course.course_name}
                                        </h4>
                                        <span class="course-action" style="color: #ff3300; font-weight: bold;">View Course</span>
                                    </div>
                                </a>
                            </li>
                        `);
                            });
                        }

                        $('#coursesPopup').show();
                    },
                    error: function() {
                        alert('Cannot get course list. Please try again later.');
                    }
                });
            });

            $(document).mouseup(function(e) {
                var popup = $("#coursesPopup");
                if (!popup.is(e.target) && popup.has(e.target).length === 0) {
                    popup.hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.back-to-top').fadeIn();
                } else {
                    $('.back-to-top').fadeOut();
                }
            });

            $('.back-to-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        });
    </script>

    <script>
        function confirmDelete(event, button) {
            event.preventDefault(); // Ngăn hành động submit form mặc định

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Gọi hàm submit của form chứa nút "delete"
                    button.closest('form').submit();
                }
            });
        }
    </script>

</body>

</html>
