<!--
=========================================================
* Material Kit 2 - v3.0.4
=========================================================

* Product Page:  https://www.creative-tim.com/product/material-kit
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        {{ __('main.page_title') }}
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-kit.css') }}?v=3.0.4" rel="stylesheet" />
    <style>
        .no-check {
            background-image: none!important;
        }

        #closeBtn {
            position: absolute!important;
            top: 10px;
            right: 10px;
            font-size: 32px;
        }
        #overlay,
        #overlay-help {
            background: #ffffff;
            color: #666666;
            position: fixed;
            height: 100%;
            width: 100%;
            z-index: 5000;
            top: 0;
            left: 0;
            float: left;
            text-align: center;
            padding-top: 20%;
            opacity: .80;
        }
        #overlay-help {
            padding-top: 20vh;
            opacity: unset;
            background-color: rgba(255, 255, 255, 0.85);
            -webkit-backdrop-filter: blur(2px);
            backdrop-filter: blur(2px);
        }
        #overlay-help p {
            padding-top: 10px;
            padding-bottom: 10px;
            margin: 0 auto 0 auto;
            max-width: 60vw;
            text-align: justify;
        }
        .spinner {
            margin: 0 auto;
            height: 64px;
            width: 64px;
            animation: rotate 0.8s infinite linear;
            border: 1px solid firebrick;
            border-right-color: transparent;
            border-radius: 50%;
        }
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 767.98px)
            .navbar-collapse .navbar-nav .nav-item.dropdown .dropdown-menu {
                left: 8px!important;
                right: 0;
            }
        @media (max-width: 991.98px)
            .dropdown.nav-item .dropdown-menu-animation.show {
                height: 130px;
                opacity: 1;
            }
    </style>

    <script>
        $(document).ready(function(){
            const latElement           = $("#lat");
            const lngElement           = $("#lng");
            const start_date           = $("#start_date");
            const end_date             = $("#end_date");
            const alert_minutes_before = $("#alert_minutes_before");
            const submitBtn            = $("#submitBtn");


            start_date.click(function(){
                start_date.parent().addClass('is-filled is-valid')
            });
            end_date.click(function(){
                end_date.parent().addClass('is-filled is-valid')
            });
            alert_minutes_before.click(function(){
                alert_minutes_before.parent().addClass('is-filled is-valid')
            });

            $("#helpBtn").click(function (){
                $('#overlay-help').fadeIn();
            })
            $("#closeBtn").click(function (){
                $('#overlay-help').fadeOut();
            })

            $(".get-location-btn").click(function(){
                $('#overlay').fadeIn();

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position){
                        $('#overlay').fadeOut()
                        latElement.val(position.coords.latitude);
                        latElement.removeAttr("disabled");
                        latElement.parent().addClass('is-filled is-valid')

                        lngElement.val(position.coords.longitude);
                        lngElement.removeAttr("disabled");
                        lngElement.parent().addClass('is-filled is-valid')

                        var now = new Date().toISOString().slice(0, 10);
                        start_date.removeAttr("disabled");
                        start_date.attr('type', 'date')
                        start_date.val(now)
                        start_date.parent().addClass('is-filled is-valid')

                        var next = dateWithMonthsDelay(1).toISOString().slice(0, 10);
                        end_date.removeAttr("disabled");
                        end_date.attr('type', 'date')
                        end_date.val(next)
                        end_date.parent().addClass('is-filled is-valid')

                        submitBtn.removeAttr("disabled");
                        submitBtn.removeClass("disabled");

                        alert_minutes_before.removeAttr("disabled");
                        alert_minutes_before.val(15);
                        alert_minutes_before.parent().addClass('is-filled is-valid')

                    });
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            });
            function dateWithMonthsDelay (months) {
                const date = new Date()
                date.setMonth(date.getMonth() + months)

                return date
            }
        });
    </script>

</head>

<body class="sign-in-basic">
<div id="overlay" style="display:none;">
    <div class="spinner"></div>
    <br/>
    {{ __('main.spinner_info') }}
</div>
<div id="overlay-help" style="display:none;">
    <div id="closeBtn" class=" cursor-pointer text-black-50 position-relative ">
<!--        <i class="fa fa-times"></i>-->
        <button class="navbar-toggler shadow-none ms-2" type="button"  aria-controls="navigation" aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
        </button>
    </div>
    <h1>{{ __('main.help_title') }}</h1>
    <p>{{  __('main.help_p1') }}</p>
    <p>{{  __('main.help_p2') }}</p>
    <p>{{  __('main.help_p3') }}</p>
    <p>{{  __('main.help_p4') }}</p>
    <h4>{{ __('main.help_ending') }}</h4>
</div>
<!-- Navbar Transparent -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3  navbar-transparent ">
    <div class="container">
        <a class="navbar-brand  text-white " href="https://demos.creative-tim.com/material-kit/presentation" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
            {{ __('main.logo') }}
        </a>


        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
        </button>
        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 ps-lg-5" id="navigation">
            <ul class="navbar-nav navbar-nav-hover ms-auto">
                <li class="nav-item dropdown dropdown-hover mx-2 ms-lg-6">
                    <a class="d-none d-lg-inline-flex nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
                        <!--              <i class="material-icons opacity-6 me-2 text-md">public</i>-->
                        @if(App::getLocale() =='ua')
                        🇺🇦
                        @elseif(App::getLocale() =='ru')
                        🇷🇺
                        @else
                        🇬🇧
                        @endif
                        <img src="{{ asset('assets/img/down-arrow-white.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
                        <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
                    </a>
                    <a class=" d-lg-none nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>
                          <i class="material-icons opacity-6 me-2 text-md" style="top: 3px; position: relative; margin-right: 1px!important;">public</i>
                          {{ __('main.language_change_language_button') }}
                        </span>
                        <img src="{{ asset('assets/img/down-arrow-white.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
                        <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" style="left: 8px;" aria-labelledby="dropdownMenuPages8">
                        <div class="d-none d-lg-block">
                            <a href="{{ route('language.change', ['locale' => 'en']) }}" class="dropdown-item border-radius-md">
                                <span>🇬🇧 {{ __('main.language_english') }}</span>
                            </a>
                            <a href="{{ route('language.change', ['locale' => 'ua']) }}" class="dropdown-item border-radius-md">
                                <span>🇺🇦 {{ __('main.language_ukrainian') }}</span>
                            </a>
                            <a href="{{ route('language.change', ['locale' => 'ru']) }}" class="dropdown-item border-radius-md">
                                <span>🇷🇺 {{ __('main.language_russian') }}</span>
                            </a>
                        </div>
                        <div class="row d-lg-none">
                            <div class="col-md-12 g-0">
                                <a href="{{ route('language.change', ['locale' => 'en']) }}" class="dropdown-item border-radius-md">
                                    <span>🇬🇧 {{ __('main.language_english') }}</span>
                                </a>
                                <a href="{{ route('language.change', ['locale' => 'ua']) }}" class="dropdown-item border-radius-md">
                                    <span>🇺🇦 {{ __('main.language_ukrainian') }}</span>
                                </a>
                                <a href="{{ route('language.change', ['locale' => 'ru']) }}" class="dropdown-item border-radius-md">
                                    <span>🇷🇺 {{ __('main.language_russian') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
              <li class="nav-item ms-lg-auto">
                <span class="nav-link nav-link-icon me-2 cursor-pointer" id="helpBtn">
                    <i class="fa fa-question-circle me-1"></i>
                  <p data-bs-toggle="collapse" data-bs-target="#navigation" class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="bottom">
                      {{ __('main.help') }}
                  </p>
                </span>
              </li>
            </ul>

        </div>

    </div>
</nav>
<!-- End Navbar -->
<div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');" loading="lazy">
    <span class="mask bg-gradient-dark opacity-6"></span>
    <div class="container my-auto">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-8 col-sm-10 col-12 mx-auto">
                <div class="card z-index-0 fadeIn3 fadeInBottom">
                    <div class="card-body">
                        <h1>{{ __('main.title') }}</h1>
                        <p class="font-italic">{{ __('main.title_info') }}</p>
                        <form role="form" method="post" action="/calculate" class="text-start">
                            @csrf
                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                <label class="form-check-label ps-2 mb-0 ms-3" for="rememberMe">{{ __('main.form_checkbox_use_location') }}</label>
                            </div>
                            <div class="input-group input-group-outline my-3">
                                <button type="button" class="btn bg-gradient-secondary w-100 mb-2 get-location-btn">{{ __('main.form_btn_get_location') }}</button>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12 pe-lg-1">
                                    <div class="input-group input-group-outline my-2">
                                        <label class="form-label" for="lat">{{ __('main.form_input_latitude') }}</label>
                                        <input type="text" id="lat" name="lat" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 ps-lg-1">
                                    <div class="input-group input-group-outline my-2">
                                        <label class="form-label" for="lng">{{ __('main.form_input_longitude') }}</label>
                                        <input type="text" id="lng" name="lng" disabled class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 pe-1">
                                    <div class="input-group input-group-outline mb-0 mt-0">
                                        <label class="form-label" for="start_date">{{ __('main.form_input_start_date') }}</label>
                                        <input type="text" id="start_date" name="start_date" class="form-control  no-check" disabled value="">
                                    </div>
                                </div>
                                <div class="col-6 ps-1">
                                    <div class="input-group input-group-outline mb-0">
                                        <label class="form-label" for="end_date">{{ __('main.form_input_end_date') }}</label>
                                        <input type="text" id="end_date" name="end_date" class="form-control no-check" disabled value="">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-outline my-2">
                                <label class="form-label" for="alert_minutes_before">{{ __('main.form_input_alert_minutes_before') }}</label>
                                <input type="number" id="alert_minutes_before" name="alert_minutes_before" value="" class="form-control" min="0" max="60" disabled>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="submitBtn" class="btn bg-gradient-primary w-100 my-4 mb-2 disabled">{{ __('main.form_btn_download') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-md-12 my-auto">
                    <div class="copyright text-center text-sm text-white">
                        © <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        {{ __('main.footer_made_with') }} <i class="fa fa-heart" style="color: red" aria-hidden="true"></i> {{ __('main.footer_by') }} {{ __('main.footer_idea_name') }} {{ __('main.footer_and') }}
                        <a href="https://popov.in" class="font-weight-bold text-white" target="_blank">{{ __('main.footer_coder_name') }}</a>,
                        {{ __('main.footer_for') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="{{ asset('assets/js/plugins/parallax.min.js')}}"></script>
<!-- Control Center for Material UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="{{ asset('assets/js/material-kit.min.js')}}?v=3.0.4" type="text/javascript"></script>
<script src="{{ asset('assets/js/plugins/flatpickr.min.js')}}"></script>

</body>

</html>
