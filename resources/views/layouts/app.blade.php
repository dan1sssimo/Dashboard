<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Notifications -->
    <!-- Notifications END-->

    <link rel="stylesheet" href="/css/style.css"/>
    <link rel="stylesheet" href="/css/light-mode.css" id="theme">
    <!-- Scripts -->
    {{--    @vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
    <link rel="stylesheet" type="text/css"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/jQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
            integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<link rel="stylesheet" type="text/css" href="/css/light-dark-mode.css">


<body>
<div id="app">
    @guest
        @if (!Route::has('login') || (Route::has('register')))
            <div class="container-nav">
                <nav class="navbar-main">
                    <div class="navbar-content">
                        <a class="navbar-link" href="#">About Us</a>
                        <a class="navbar-link" href="#">Faq</a>
                        <a class="navbar-link" href="#">Help</a>
                        <a class="navbar-link" href="#">Contact Us</a>
                    </div>
                </nav>
            </div>
        @endif
    @else
        <nav class="navbar-main-dashboard">
            <div class="nav-dashboard-container">
                <div class="nav-dashboard-content">
                    <div class="nav-dashboard-logo">
                        <a class="nav-d-logo" href="{{route('home')}}">
                            <img id="main-logo-img" class="nav-d-logo-img" src="/materials/images/workfitdxr_logo_1.png">
                        </a>
                        <div class="nav-dashboard-title">
                            <p class="nav-dashboard-title-text">A better way to address the gap in employee
                                satisfaction</p>
                        </div>
                    </div>
                    <div class="nav-dashboard-options">
                        <div class="nav-d-theme">
                            <div class="nav-d-text-theme-w">White theme</div>
                            <div class="nav-d-change-theme">
                                <input id="xxx" name="xxx" type="checkbox" onclick="bg()" style="cursor: pointer">
                                @if(Auth::user()->tariff !== 1)
                                    <script>
                                        document.getElementById("xxx").disabled = true;
                                        document.getElementById("xxx2").disabled = true;
                                        $("#xxx").attr("title", "You can't change colors");
                                        $("#xxx2").attr("title", "You can't change colors");
                                    </script>
                                @endif
                                <script src="/js/theme.js"></script>
                            </div>
                            <div class="nav-d-text-theme-d">Dark theme</div>
                        </div>

                        <div class="nav-item dropdown">
                            <div class="m-2">
                                <a href="{{ route('profile') }}">
                                    <img xmlns="http://www.w3.org/2000/svg"
                                         class="sidebar-avatar-image"
                                         viewBox="0 -100 448 612"
                                         src="{{ (!empty(Auth::user()->image))?url('upload/'.Auth::user()->image):url('upload/no_image.jpg') }}"
                                         alt="User Avatar"
                                         width="50px" height="50px">
                                </a>
                                <!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                            </div>

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <p class="nav-name-text-hi ">Hi, </p>
                                <p class="nav-name-text" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                            </a>

                            @if(Auth::user()->admin === "yes")
                                <div class="nav-profile-status"></div>
                            @endif

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    {{ __('Home') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    {{ __('Profile') }}
                                </a>
                                @if(Auth::user()->manager === "yes" || Auth::user()->chief === "yes" || Auth::user()->teamlead === "yes" || Auth::user()->admin === "yes")
                                    <a class="dropdown-item" href="/users" id="update-coworkers" style="cursor:pointer;">
                                        @if(Auth::user()->manager === "yes" || Auth::user()->chief === "yes" || Auth::user()->teamlead === "yes"){{ __('Сompany staff') }}@elseif(Auth::user()->admin === "yes"){{ __('Admin panel') }}@endif
                                    </a>
                                @if(Auth::user()->admin !== "yes")
                                    <a href="#" class="dropdown-item show-test-results" style="cursor:pointer;">Save test results</a>
                                @endif
                                @endif
                                @if(Auth::user()->admin === "yes")<a class="dropdown-item" href="/companies">Companies</a>@endif
                                @if(Auth::user()->manager === "yes")<a class="dropdown-item" href="/departments">Departments</a>@endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </div>
                        <div class="nav-menu-dots" style="display: none">
                            <a class="btn btn-primary" href="/payment" style="margin-right: 30px">Our offers</a>
                            <a>
                                <svg version="1.1"
                                     id="Capa_1"
                                     xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     width="23px"
                                     height="23px"
                                     viewBox="0 0 408 408" style="enable-background:new 0 0 408 408;"
                                     xml:space="preserve">
                                    <path d="M51,153c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S79.05,153,51,153z M357,153c-28.05,0-51,22.95-51,51
                                        s22.95,51,51,51s51-22.95,51-51S385.05,153,357,153z M204,153c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51
                                        S232.05,153,204,153z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @endguest

    <main>
        @yield('content')
    </main>
    @guest
        @if (!Route::has('login') || (Route::has('register')))
            <footer class="footer-main">
                <div class="footer-content">
                    <div class="f-list">
                        <p class="f-text">Terms of Service</p>
                        <p class="f-text">Privacy Policy</p>
                        <p class="f-text">Notice at Collection</p>
                        <p class="f-text">Cookie Settings</p>
                        <p class="f-text">Accessibility</p>
                    </div>
                    <div class="f-sublist">
                        <p class="f-sub-text">© 2015 - 2022 Workfitdxr® Global Inc.</p>
                    </div>
                </div>
            </footer>
        @endif
    @else
        <footer class="footer-dashboard-main">
            <div class="footer-content">
                <div class="footer-dashboard-content">
                    <div class="f-d-content-1">
                        © 2015 - 2022 Workfitdxr® Global Inc.
                    </div>
                    <div class="f-d-content-2">
                        <div>
                            Terms of Service
                        </div>
                        <div>
                            Privacy Policy
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    @endguest
</div>

<script>
    window.onload = () =>
    {
        if(localStorage.getItem("img") !== null)
        {
            document.getElementById("main-logo-img").src = localStorage.getItem("img")
        }
        $(".home-container").css("backgroundColor", localStorage.getItem("home-container"))
        $("#xxx").attr("checked", localStorage.getItem("checked"))
        $("#xxx2").attr("checked", localStorage.getItem("checked"))
        $(".navbar-main-dashboard").css("backgroundColor", localStorage.getItem("navbar-main-dashboard"))
        $(".nav-dashboard-title-text").css("color", localStorage.getItem("nav-dashboard-title-text"))
        $(".nav-name-text-hi").css("color", localStorage.getItem("nav-name-text-hi"))
        $(".nav-name-text").css("color", localStorage.getItem("nav-name-text"))
        $(".nav-d-text-theme-w").css("color", localStorage.getItem("nav-d-text-theme-w-color"))
        $(".nav-d-text-theme-w").css("fontWeight", localStorage.getItem("nav-d-text-theme-w-weight"))
        $(".nav-d-text-theme-d").css("color", localStorage.getItem("nav-d-text-theme-d-color"))
        $(".nav-d-text-theme-d").css("fontWeight", localStorage.getItem("nav-d-text-theme-d-weight"))
        $(".home-h-title").css("color", localStorage.getItem("home-h-title"))
        $(".path-satisfaction").css("fill", localStorage.getItem("path-satisfaction"))
        $(".box2-title").css("color", localStorage.getItem("box2-title"))
        $(".box3-title").css("color", localStorage.getItem("box3-title"))
        $(".sidebar-button-on-text").css("color", localStorage.getItem("sidebar-button-on-text"))
    }
</script>
</body>
</html>
@yield('script')
