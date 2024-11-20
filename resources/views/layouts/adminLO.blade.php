<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="img-dasboard/apple-icon.png">
    <link rel="icon" type="image/png" href="uploads/img-dasboard/favicon.png">
    <title>
        Admin
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/path/to/bootstrap-icons.css" rel="stylesheet">

    <link href="/path/to/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

    <!-- Toast Notification -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            overflow-y: auto;
        }

        /* From Uiverse.io by Galahhad */
        /* The design is inspired from the mockapi.io */

        .popup {
            --burger-line-width: 1.125em;
            --burger-line-height: 0.125em;
            --burger-offset: 0.625em;
            --burger-bg: rgba(255, 255, 255, 0.8);
            --burger-color: #333;
            --burger-line-border-radius: 0.1875em;
            --burger-diameter: 2.125em;
            --burger-btn-border-radius: calc(var(--burger-diameter) / 2);
            --burger-line-transition: .3s;
            --burger-transition: all .1s ease-in-out;
            --burger-hover-scale: 1.1;
            --burger-active-scale: .95;
            --burger-enable-outline-color: var(--burger-bg);
            --burger-enable-outline-width: 0.125em;
            --burger-enable-outline-offset: var(--burger-enable-outline-width);
            /* nav */
            --nav-padding-x: 0.25em;
            --nav-padding-y: 0.625em;
            --nav-border-radius: 0.375em;
            --nav-border-color: #ccc;
            --nav-border-width: 0.0625em;
            --nav-shadow-color: rgba(0, 0, 0, .2);
            --nav-shadow-width: 0 1px 5px;
            --nav-bg: #eee;
            --nav-font-family: Poppins, sans-serif --nav-default-scale: .8;
            --nav-active-scale: 1;
            --nav-position-left: unset;
            --nav-position-right: 0;
            /* if you want to change sides just switch one property */
            /* from properties to "unset" and the other to 0 */
            /* title */
            --nav-title-size: 0.625em;
            --nav-title-color: #777;
            --nav-title-padding-x: 1rem;
            --nav-title-padding-y: 0.25em;
            /* nav button */
            --nav-button-padding-x: 1rem;
            --nav-button-padding-y: 0.375em;
            --nav-button-border-radius: 0.375em;
            --nav-button-font-size: 12px;
            --nav-button-hover-bg: #6495ed;
            --nav-button-hover-text-color: #fff;
            --nav-button-distance: 0.875em;
            /* underline */
            --underline-border-width: 0.0625em;
            --underline-border-color: #ccc;
            --underline-margin-y: 0.3125em;
        }

        /* popup settings 👆 */

        .popup {
            display: inline-block;
            text-rendering: optimizeLegibility;
            position: relative;
        }

        .popup input {
            display: none;
        }

        .burger {
            display: flex;
            position: relative;
            align-items: center;
            justify-content: center;
            background: var(--burger-bg);
            width: var(--burger-diameter);
            height: var(--burger-diameter);
            border-radius: var(--burger-btn-border-radius);
            border: none;
            cursor: pointer;
            overflow: hidden;
            transition: var(--burger-transition);
            outline: var(--burger-enable-outline-width) solid transparent;
            outline-offset: 0;
        }

        .burger span {
            height: var(--burger-line-height);
            width: var(--burger-line-width);
            background: var(--burger-color);
            border-radius: var(--burger-line-border-radius);
            position: absolute;
            transition: var(--burger-line-transition);
        }

        .burger span:nth-child(1) {
            top: var(--burger-offset);
        }

        .burger span:nth-child(2) {
            bottom: var(--burger-offset);
        }

        .burger span:nth-child(3) {
            top: 50%;
            transform: translateY(-50%);
        }

        .popup-window {
            transform: scale(var(--nav-default-scale));
            visibility: hidden;
            opacity: 0;
            position: absolute;
            padding: var(--nav-padding-y) var(--nav-padding-x);
            background: var(--nav-bg);
            font-family: var(--nav-font-family);
            color: var(--nav-text-color);
            border-radius: var(--nav-border-radius);
            box-shadow: var(--nav-shadow-width) var(--nav-shadow-color);
            border: var(--nav-border-width) solid var(--nav-border-color);
            top: calc(var(--burger-diameter) + var(--burger-enable-outline-width) + var(--burger-enable-outline-offset));
            left: var(--nav-position-left);
            right: var(--nav-position-right);
            transition: var(--burger-transition);
        }

        .popup-window legend {
            padding: var(--nav-title-padding-y) var(--nav-title-padding-x);
            margin: 0;
            color: var(--nav-title-color);
            font-size: var(--nav-title-size);
            text-transform: uppercase;
        }

        .popup-window ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .popup-window ul button {
            outline: none;
            width: 100%;
            border: none;
            background: none;
            display: flex;
            align-items: center;
            color: var(--burger-color);
            font-size: var(--nav-button-font-size);
            padding: var(--nav-button-padding-y) var(--nav-button-padding-x);
            white-space: nowrap;
            border-radius: var(--nav-button-border-radius);
            cursor: pointer;
            column-gap: var(--nav-button-distance);
        }

        .popup-window ul li:nth-child(1) svg,
        .popup-window ul li:nth-child(2) svg {
            color: cornflowerblue;
        }

        .popup-window ul li:nth-child(4) svg,
        .popup-window ul li:nth-child(5) svg {
            color: rgb(153, 153, 153);
        }

        .popup-window ul li:nth-child(7) svg {
            color: red;
        }

        .popup-window hr {
            margin: var(--underline-margin-y) 0;
            border: none;
            border-bottom: var(--underline-border-width) solid var(--underline-border-color);
        }

        /* actions */

        .popup-window ul button:hover,
        .popup-window ul button:focus-visible,
        .popup-window ul button:hover svg,
        .popup-window ul button:focus-visible svg {
            color: var(--nav-button-hover-text-color);
            background: var(--nav-button-hover-bg);
        }

        .burger:hover {
            transform: scale(var(--burger-hover-scale));
        }

        .burger:active {
            transform: scale(var(--burger-active-scale));
        }

        .burger:focus:not(:hover) {
            outline-color: var(--burger-enable-outline-color);
            outline-offset: var(--burger-enable-outline-offset);
        }

        .popup input:checked+.burger span:nth-child(1) {
            top: 50%;
            transform: translateY(-50%) rotate(45deg);
        }

        .popup input:checked+.burger span:nth-child(2) {
            bottom: 50%;
            transform: translateY(50%) rotate(-45deg);
        }

        .popup input:checked+.burger span:nth-child(3) {
            transform: translateX(calc(var(--burger-diameter) * -1 - var(--burger-line-width)));
        }

        .popup input:checked~nav {
            transform: scale(var(--nav-active-scale));
            visibility: visible;
            opacity: 1;
        }

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

</head>

<body class="">
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <div class="logo" style="text-align: center;">
                    <a href="{{ route('admin') }}" class="simple-text logo-normal">Dashboard</a>
                </div>
                <ul class="nav">
                    <li>
                        <a href="{{ route('admin.accounts.index') }}">
                            <i class="bi bi-person"></i>
                            <p>Accounts</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-blockquote-left"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.courses.index') }}">
                            <i class="bi bi-journals"></i>
                            <p>Courses</p>
                        </a>
                    </li>
                    <li>
                        <a href="./tables.html">
                            <i class="bi bi-table"></i>
                            <p>View statistics</p>
                        </a>
                    </li>
                    <hr style="background: white; width: 90%;">
                    <li>
                        <a href="{{ route('homepage') }}">
                            <i class="bi bi-house"></i>
                            <p>Back to hompage</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <span style="color: white; font-size: 20px; font-weight: bold; position: fixed;"
                            class="navbar-text">ADMIN</span>
                        <ul class="navbar-nav ml-auto">
                            <li class="dropdown nav-item">
                                <label class="popup">
                                    <input type="checkbox">
                                    <div class="burger" tabindex="0">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <nav class="popup-window">
                                        <legend>Actions</legend>
                                        <ul>
                                            <li>
                                                <a href="{{ route('profile') }}">
                                                    <button>
                                                        <i class="bi bi-person-circle"></i>
                                                        <span>Profile</span>
                                                    </button>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('homepage.logout') }}">
                                                    <button>
                                                        <i class="bi bi-box-arrow-right"></i>
                                                        <span>Log out</span>
                                                    </button>
                                                </a>
                                            </li>
                                            <hr>
                                            <li>
                                                <a href="{{ route('homepage') }}">
                                                    <button>
                                                        <i class="bi bi-house"></i>
                                                        <span>Back to homepage</span>
                                                    </button>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog"
                aria-labelledby="searchModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="tim-icons icon-simple-remove"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main content -->
            @yield('main')
        </div>
    </div>
    <div class="fixed-plugin">
        <div class="dropdown show-dropdown">
            <a href="#" data-toggle="dropdown">
                <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title"> Sidebar Background</li>
                <li class="adjustments-line">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors text-center">
                            <span class="badge filter badge-primary active" data-color="primary"></span>
                            <span class="badge filter badge-info" data-color="blue"></span>
                            <span class="badge filter badge-success" data-color="green"></span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li class="adjustments-line text-center color-change">
                    <span class="color-label">LIGHT MODE</span>
                    <span class="badge light-badge mr-2"></span>
                    <span class="badge dark-badge ml-2"></span>
                    <span class="color-label">DARK MODE</span>
                </li>
                <li class="button-container">
                    <a href="https://www.creative-tim.com/product/black-dashboard" target="_blank"
                        class="btn btn-primary btn-block btn-round">Download Now</a>
                    <a href="https://demos.creative-tim.com/black-dashboard/docs/1.0/getting-started/introduction.html"
                        target="_blank" class="btn btn-default btn-block btn-round">
                        Documentation
                    </a>
                </li>
                <li class="header-title">Thank you for 95 shares!</li>
                <li class="button-container text-center">
                    <button id="twitter" class="btn btn-round btn-info"><i class="fab fa-twitter"></i> &middot;
                        45</button>
                    <button id="facebook" class="btn btn-round btn-info"><i class="fab fa-facebook-f"></i> &middot;
                        50</button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Back to Top -->
    <button id="scrollToTopBtn" class="back-to-top" style="display: none;">↑</button>

    <!--   Core JS Files   -->
    <script src="js-dasboard/core/jquery.min.js"></script>
    <script src="js-dasboard/core/popper.min.js"></script>
    <script src="js-dasboard/core/bootstrap.min.js"></script>
    <script src="js-dasboard/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="js-dasboard/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="js-dasboard/plugins/bootstrap-notify.js"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="js-dasboard/black-dashboard.min.js?v=1.0.0"></script>
    <!-- toast notification -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            $().ready(function() {
                $sidebar = $('.sidebar');
                $navbar = $('.navbar');
                $main_panel = $('.main-panel');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;
                white_color = false;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                $('.fixed-plugin a').click(function(event) {
                    if ($(this).hasClass('switch-trigger')) {
                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else if (window.event) {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                $('.fixed-plugin .background-color span').click(function() {
                    $(this).siblings().removeClass('active');
                    $(this).addClass('active');

                    var new_color = $(this).data('color');

                    if ($sidebar.length != 0) {
                        $sidebar.attr('data', new_color);
                    }

                    if ($main_panel.length != 0) {
                        $main_panel.attr('data', new_color);
                    }

                    if ($full_page.length != 0) {
                        $full_page.attr('filter-color', new_color);
                    }

                    if ($sidebar_responsive.length != 0) {
                        $sidebar_responsive.attr('data', new_color);
                    }
                });

                $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (sidebar_mini_active == true) {
                        $('body').removeClass('sidebar-mini');
                        sidebar_mini_active = false;
                        blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                    } else {
                        $('body').addClass('sidebar-mini');
                        sidebar_mini_active = true;
                        blackDashboard.showSidebarMessage('Sidebar mini activated...');
                    }

                    // we simulate the window Resize so the charts will get updated in realtime.
                    var simulateWindowResize = setInterval(function() {
                        window.dispatchEvent(new Event('resize'));
                    }, 180);

                    // we stop the simulation of Window Resize after the animations are completed
                    setTimeout(function() {
                        clearInterval(simulateWindowResize);
                    }, 1000);
                });

                $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                    var $btn = $(this);

                    if (white_color == true) {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').removeClass('white-content');
                        }, 900);
                        white_color = false;
                    } else {

                        $('body').addClass('change-background');
                        setTimeout(function() {
                            $('body').removeClass('change-background');
                            $('body').addClass('white-content');
                        }, 900);

                        white_color = true;
                    }


                });

                $('.light-badge').click(function() {
                    $('body').addClass('white-content');
                });

                $('.dark-badge').click(function() {
                    $('body').removeClass('white-content');
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

        });
    </script>
    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "black-dashboard-free"
            });
    </script>

    <script>
        function toggleActions(button) {
            const actionButtons = button.nextElementSibling;
            const isVisible = actionButtons.style.display === 'block';
            actionButtons.style.display = isVisible ? 'none' : 'block';
            button.classList.toggle('active', !isVisible);
            button.innerHTML = isVisible ? '<i class="bi bi-list"></i>' : '<i class="bi bi-x"></i>';
        }

        function confirmDelete(event, button) {
            event.preventDefault(); // Ngăn hành đ���ng submit form mặc đ��nh

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

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('current-image');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function updateFileName(event) {
            var fileInput = event.target;
            var fileName = fileInput.files[0].name;
            var currentFileLink = document.getElementById('current-file');
            currentFileLink.textContent = fileName;
        }
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
                $('html, body').animate({ scrollTop: 0 }, 800);
                return false;
            });
        });
    </script>

</body>

</html>
