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

        #overlay {
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
            padding-top: 40%;
            opacity: .80;
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
            <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuPages8" data-bs-toggle="dropdown" aria-expanded="false">
<!--              <i class="material-icons opacity-6 me-2 text-md">public</i>-->
                @if(App::getLocale() =='ua')
                🇺🇦 Українська
                @elseif(App::getLocale() =='ru')
                🇷🇺 Русский
                @else
                🇬🇧 English
                @endif
              <img src="{{ asset('assets/img/down-arrow-white.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">
              <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">
            </a>
            <div class="dropdown-menu dropdown-menu-animation ms-n3 dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuPages8">
              <div class="d-none d-lg-block">
<!--                <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">-->
<!--                  Landing Pages-->
<!--                </h6>-->
                <a href="{{ route('language.change', ['locale' => 'en']) }}" class="dropdown-item border-radius-md">
                  <span>English</span>
                </a>
                <a href="{{ route('language.change', ['locale' => 'ua']) }}" class="dropdown-item border-radius-md">
                  <span>Ukrainian</span>
                </a>
                <a href="{{ route('language.change', ['locale' => 'ru']) }}" class="dropdown-item border-radius-md">
                  <span>Russian</span>
                </a>
              </div>
<!--              <div class="d-lg-none">-->
<!--                <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1">-->
<!--                  Landing Pages-->
<!--                </h6>-->
<!--                <a href="../../../../../Downloads/material-kit-master/pages/about-us.html" class="dropdown-item border-radius-md">-->
<!--                  <span>About Us</span>-->
<!--                </a>-->
<!--                <a href="../../../../../Downloads/material-kit-master/pages/contact-us.html" class="dropdown-item border-radius-md">-->
<!--                  <span>Contact Us</span>-->
<!--                </a>-->
<!--                <a href="../../../../../Downloads/material-kit-master/pages/author.html" class="dropdown-item border-radius-md">-->
<!--                  <span>Author</span>-->
<!--                </a>-->
<!--                <h6 class="dropdown-header text-dark font-weight-bolder d-flex align-items-center px-1 mt-3">-->
<!--                  Account-->
<!--                </h6>-->
<!--                <a href="../pages/sign-in.html" class="dropdown-item border-radius-md">-->
<!--                  <span>Sign In</span>-->
<!--                </a>-->
<!--              </div>-->
            </div>
          </li>
<!--          <li class="nav-item dropdown dropdown-hover mx-2">-->
<!--            <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuBlocks" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--              <i class="material-icons opacity-6 me-2 text-md">view_day</i>-->
<!--              Sections-->
<!--              <img src="{{ asset('assets/img/down-arrow-white.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">-->
<!--              <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">-->
<!--            </a>-->
<!--            <ul class="dropdown-menu dropdown-menu-animation dropdown-menu-end dropdown-md dropdown-md-responsive p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="dropdownMenuBlocks">-->
<!--              <div class="d-none d-lg-block">-->
<!--                <li class="nav-item dropdown dropdown-hover dropdown-subitem">-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/presentation.html">-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Page Sections</h6>-->
<!--                        <span class="text-sm">See all sections</span>-->
<!--                      </div>-->
<!--                      <img src="{{ asset('assets/img/down-arrow.svg')}}" alt="down-arrow" class="arrow">-->
<!--                    </div>-->
<!--                  </a>-->
<!--                  <div class="dropdown-menu mt-0 py-3 px-2 mt-3">-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/page-sections/hero-sections.html">-->
<!--                      Page Headers-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/page-sections/features.html">-->
<!--                      Features-->
<!--                    </a>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li class="nav-item dropdown dropdown-hover dropdown-subitem">-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/presentation.html">-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Navigation</h6>-->
<!--                        <span class="text-sm">See all navigations</span>-->
<!--                      </div>-->
<!--                      <img src="{{ asset('assets/img/down-arrow.svg')}}" alt="down-arrow" class="arrow">-->
<!--                    </div>-->
<!--                  </a>-->
<!--                  <div class="dropdown-menu mt-0 py-3 px-2 mt-3">-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/navigation/navbars.html">-->
<!--                      Navbars-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/navigation/nav-tabs.html">-->
<!--                      Nav Tabs-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/navigation/pagination.html">-->
<!--                      Pagination-->
<!--                    </a>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li class="nav-item dropdown dropdown-hover dropdown-subitem">-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/presentation.html">-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Input Areas</h6>-->
<!--                        <span class="text-sm">See all input areas</span>-->
<!--                      </div>-->
<!--                      <img src="{{ asset('assets/img/down-arrow.svg')}}" alt="down-arrow" class="arrow">-->
<!--                    </div>-->
<!--                  </a>-->
<!--                  <div class="dropdown-menu mt-0 py-3 px-2 mt-3">-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/input-areas/inputs.html">-->
<!--                      Inputs-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/input-areas/forms.html">-->
<!--                      Forms-->
<!--                    </a>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li class="nav-item dropdown dropdown-hover dropdown-subitem">-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/presentation.html">-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Attention Catchers</h6>-->
<!--                        <span class="text-sm">See all examples</span>-->
<!--                      </div>-->
<!--                      <img src="{{ asset('assets/img/down-arrow.svg')}}" alt="down-arrow" class="arrow">-->
<!--                    </div>-->
<!--                  </a>-->
<!--                  <div class="dropdown-menu mt-0 py-3 px-2 mt-3">-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/attention-catchers/alerts.html">-->
<!--                      Alerts-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/attention-catchers/modals.html">-->
<!--                      Modals-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/attention-catchers/tooltips-popovers.html">-->
<!--                      Tooltips & Popovers-->
<!--                    </a>-->
<!--                  </div>-->
<!--                </li>-->
<!--                <li class="nav-item dropdown dropdown-hover dropdown-subitem">-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/presentation.html">-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Elements</h6>-->
<!--                        <span class="text-sm">See all elements</span>-->
<!--                      </div>-->
<!--                      <img src="{{ asset('assets/img/down-arrow.svg')}}" alt="down-arrow" class="arrow">-->
<!--                    </div>-->
<!--                  </a>-->
<!--                  <div class="dropdown-menu mt-0 py-3 px-2 mt-3">-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/avatars.html">-->
<!--                      Avatars-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/badges.html">-->
<!--                      Badges-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/breadcrumbs.html">-->
<!--                      Breadcrumbs-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/buttons.html">-->
<!--                      Buttons-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/dropdowns.html">-->
<!--                      Dropdowns-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/progress-bars.html">-->
<!--                      Progress Bars-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/toggles.html">-->
<!--                      Toggles-->
<!--                    </a>-->
<!--                    <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/typography.html">-->
<!--                      Typography-->
<!--                    </a>-->
<!--                  </div>-->
<!--                </li>-->
<!--              </div>-->
<!--              <div class="row d-lg-none">-->
<!--                <div class="col-md-12">-->
<!--                  <div class="d-flex mb-2">-->
<!--                    <div class="icon h-10 me-3 d-flex mt-1">-->
<!--                      <i class="ni ni-single-copy-04 text-gradient text-primary"></i>-->
<!--                    </div>-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Page Sections</h6>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/page-sections/hero-sections.html">-->
<!--                    Page Headers-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/page-sections/features.html">-->
<!--                    Features-->
<!--                  </a>-->
<!--                  <div class="d-flex mb-2 mt-3">-->
<!--                    <div class="icon h-10 me-3 d-flex mt-1">-->
<!--                      <i class="ni ni-laptop text-gradient text-primary"></i>-->
<!--                    </div>-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Navigation</h6>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/navigation/navbars.html">-->
<!--                    Navbars-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/navigation/nav-tabs.html">-->
<!--                    Nav Tabs-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/navigation/pagination.html">-->
<!--                    Pagination-->
<!--                  </a>-->
<!--                  <div class="d-flex mb-2 mt-3">-->
<!--                    <div class="icon h-10 me-3 d-flex mt-1">-->
<!--                      <i class="ni ni-badge text-gradient text-primary"></i>-->
<!--                    </div>-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Input Areas</h6>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/input-areas/inputs.html">-->
<!--                    Inputs-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/input-areas/forms.html">-->
<!--                    Forms-->
<!--                  </a>-->
<!--                  <div class="d-flex mb-2 mt-3">-->
<!--                    <div class="icon h-10 me-3 d-flex mt-1">-->
<!--                      <i class="ni ni-notification-70 text-gradient text-primary"></i>-->
<!--                    </div>-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Attention Catchers</h6>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/attention-catchers/alerts.html">-->
<!--                    Alerts-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/attention-catchers/modals.html">-->
<!--                    Modals-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/attention-catchers/tooltips-popovers.html">-->
<!--                    Tooltips & Popovers-->
<!--                  </a>-->
<!--                  <div class="d-flex mb-2 mt-3">-->
<!--                    <div class="icon h-10 me-3 d-flex mt-1">-->
<!--                      <i class="ni ni-app text-gradient text-primary"></i>-->
<!--                    </div>-->
<!--                    <div class="w-100 d-flex align-items-center justify-content-between">-->
<!--                      <div>-->
<!--                        <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Elements</h6>-->
<!--                      </div>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/avatars.html">-->
<!--                    Avatars-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/badges.html">-->
<!--                    Badges-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/breadcrumbs.html">-->
<!--                    Breadcrumbs-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/buttons.html">-->
<!--                    Buttons-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/dropdowns.html">-->
<!--                    Dropdowns-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/progress-bars.html">-->
<!--                    Progress Bars-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/toggles.html">-->
<!--                    Toggles-->
<!--                  </a>-->
<!--                  <a class="dropdown-item ps-3 border-radius-md mb-1" href="../../../../../Downloads/material-kit-master/sections/elements/typography.html">-->
<!--                    Typography-->
<!--                  </a>-->
<!--                </div>-->
<!--              </div>-->
<!--            </ul>-->
<!--          </li>-->
<!--          <li class="nav-item dropdown dropdown-hover mx-2">-->
<!--            <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" id="dropdownMenuDocs" data-bs-toggle="dropdown" aria-expanded="false">-->
<!--              <i class="material-icons opacity-6 me-2 text-md">article</i>-->
<!--              Docs-->
<!--              <img src="{{ asset('assets/img/down-arrow-white.svg')}}" alt="down-arrow" class="arrow ms-2 d-lg-block d-none">-->
<!--              <img src="{{ asset('assets/img/down-arrow-dark.svg')}}" alt="down-arrow" class="arrow ms-2 d-lg-none d-block">-->
<!--            </a>-->
<!--            <ul class="dropdown-menu dropdown-menu-animation dropdown-menu-end dropdown-md dropdown-md-responsive mt-0 mt-lg-3 p-3 border-radius-lg" aria-labelledby="dropdownMenuDocs">-->
<!--              <div class="d-none d-lg-block">-->
<!--                <ul class="list-group">-->
<!--                  <li class="nav-item list-group-item border-0 p-0">-->
<!--                    <a class="dropdown-item py-2 ps-3 border-radius-md" href=" https://www.creative-tim.com/learning-lab/bootstrap/overview/material-kit ">-->
<!--                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Getting Started</h6>-->
<!--                      <span class="text-sm">All about overview, quick start, license and contents</span>-->
<!--                    </a>-->
<!--                  </li>-->
<!--                  <li class="nav-item list-group-item border-0 p-0">-->
<!--                    <a class="dropdown-item py-2 ps-3 border-radius-md" href=" https://www.creative-tim.com/learning-lab/bootstrap/colors/material-kit ">-->
<!--                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Foundation</h6>-->
<!--                      <span class="text-sm">See our colors, icons and typography</span>-->
<!--                    </a>-->
<!--                  </li>-->
<!--                  <li class="nav-item list-group-item border-0 p-0">-->
<!--                    <a class="dropdown-item py-2 ps-3 border-radius-md" href=" https://www.creative-tim.com/learning-lab/bootstrap/alerts/material-kit ">-->
<!--                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Components</h6>-->
<!--                      <span class="text-sm">Explore our collection of fully designed components</span>-->
<!--                    </a>-->
<!--                  </li>-->
<!--                  <li class="nav-item list-group-item border-0 p-0">-->
<!--                    <a class="dropdown-item py-2 ps-3 border-radius-md" href=" https://www.creative-tim.com/learning-lab/bootstrap/datepicker/material-kit ">-->
<!--                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Plugins</h6>-->
<!--                      <span class="text-sm">Check how you can integrate our plugins</span>-->
<!--                    </a>-->
<!--                  </li>-->
<!--                  <li class="nav-item list-group-item border-0 p-0">-->
<!--                    <a class="dropdown-item py-2 ps-3 border-radius-md" href=" https://www.creative-tim.com/learning-lab/bootstrap/utilities/material-kit ">-->
<!--                      <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Utility Classes</h6>-->
<!--                      <span class="text-sm">For those who want flexibility, use our utility classes</span>-->
<!--                    </a>-->
<!--                  </li>-->
<!--                </ul>-->
<!--              </div>-->
<!--              <div class="row d-lg-none">-->
<!--                <div class="col-md-12 g-0">-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/pages/about-us.html">-->
<!--                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Getting Started</h6>-->
<!--                    <span class="text-sm">All about overview, quick start, license and contents</span>-->
<!--                  </a>-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/pages/about-us.html">-->
<!--                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Foundation</h6>-->
<!--                    <span class="text-sm">See our colors, icons and typography</span>-->
<!--                  </a>-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/pages/about-us.html">-->
<!--                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Components</h6>-->
<!--                    <span class="text-sm">Explore our collection of fully designed components</span>-->
<!--                  </a>-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/pages/about-us.html">-->
<!--                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Plugins</h6>-->
<!--                    <span class="text-sm">Check how you can integrate our plugins</span>-->
<!--                  </a>-->
<!--                  <a class="dropdown-item py-2 ps-3 border-radius-md" href="../../../../../Downloads/material-kit-master/pages/about-us.html">-->
<!--                    <h6 class="dropdown-header text-dark font-weight-bolder d-flex justify-content-cente align-items-center p-0">Utility Classes</h6>-->
<!--                    <span class="text-sm">For those who want flexibility, use our utility classes</span>-->
<!--                  </a>-->
<!--                </div>-->
<!--              </div>-->
<!--            </ul>-->
<!--          </li>-->
<!--          <li class="nav-item ms-lg-auto">-->
<!--            <a class="nav-link nav-link-icon me-2" href="https://github.com/creativetimofficial/soft-ui-design-system" target="_blank">-->
<!--              <i class="fa fa-github me-1"></i>-->
<!--              <p class="d-inline text-sm z-index-1 font-weight-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Star us on Github">Github</p>-->
<!--            </a>-->
<!--          </li>-->
<!--          <li class="nav-item my-auto ms-3 ms-lg-0">-->
<!--            <a href="https://www.creative-tim.com/product/material-kit-pro" class="btn btn-sm  bg-gradient-primary  mb-0 me-1 mt-2 mt-md-0">Upgrade to Pro</a>-->
<!--          </li>-->
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

<!--            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Generate calendar</h4>
                  <div class="row mt-3">
                      <div class="col-12 text-center ms-auto text-white">
                        Generate 3 sanghya's calendar for your location
                      </div>
                  </div>
                <div class="row mt-3">
                  <div class="col-2 text-center ms-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-facebook text-white text-lg"></i>
                    </a>
                  </div>
                  <div class="col-2 text-center px-1">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-github text-white text-lg"></i>
                    </a>
                  </div>
                  <div class="col-2 text-center me-auto">
                    <a class="btn btn-link px-3" href="javascript:;">
                      <i class="fa fa-google text-white text-lg"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>-->

            <div class="card-body">
                <h1>{{ __('main.title') }}</h1>
                <p class="font-italic">{{ __('main.title_info') }}</p>
              <form role="form" method="post" action="/calculate" class="text-start">
                  @csrf

              <div class="input-group input-group-outline my-3">
                  <button type="button" class="btn bg-gradient-secondary w-100 mb-2 get-location-btn">{{ __('main.form_btn_get_location') }}</button>
              </div>
                <div class="input-group input-group-outline my-2">
                  <label class="form-label" for="lat">{{ __('main.form_input_latitude') }}</label>
                  <input type="text" id="lat" name="lat" disabled class="form-control">
                </div>
                <div class="input-group input-group-outline my-2">
                  <label class="form-label" for="lng">{{ __('main.form_input_longitude') }}</label>
                  <input type="text" id="lng" name="lng" disabled class="form-control">
                </div>
                  <div class="input-group input-group-outline mb-2 mt-3">
                      <label class="form-label" for="start_date">{{ __('main.form_input_start_date') }}</label>
                      <input type="text" id="start_date" name="start_date" class="form-control  no-check" disabled value="">

                  </div>
                  <div class="input-group input-group-outline mb-2">
                      <label class="form-label" for="end_date">{{ __('main.form_input_end_date') }}</label>
                      <input type="text" id="end_date" name="end_date" class="form-control no-check" disabled value="">
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
          <div class="col-12 col-md-6 my-auto">
            <div class="copyright text-center text-sm text-white">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
                {{ __('main.footer_made_with') }} <i class="fa fa-heart" style="color: red" aria-hidden="true"></i> {{ __('main.footer_by') }}
              <a href="https://popov.in" class="font-weight-bold text-white" target="_blank">{{ __('main.footer_name') }}</a>
                {{ __('main.footer_for') }}
            </div>
          </div>
<!--          <div class="col-12 col-md-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link text-white" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-white" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-white" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-white" target="_blank">License</a>
              </li>
            </ul>
          </div>-->
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



  <script>
      // var latElement = document.getElementById("lat");
      // var lngElement = document.getElementById("lng");
      // var start_date = document.getElementById("start_date");
      // var end_date = document.getElementById("end_1date");
      // var submitBtn = document.getElementById("submitBtn");
      // var alert_minutes_before = document.getElementById("alert_minutes_before");
      //
      // function getLocation() {
      //     if (navigator.geolocation) {
      //         navigator.geolocation.getCurrentPosition(showPosition);
      //     } else {
      //         x.innerHTML = "Geolocation is not supported by this browser.";
      //     }
      // }
      //
      // function showPosition(position) {
      //     latElement.value = position.coords.latitude;
      //     latElement.removeAttribute("disabled");
      //     latElement.parentElement.classList.add('is-filled')
      //
      //     lngElement.value =  position.coords.longitude;
      //     lngElement.removeAttribute("disabled");
      //     lngElement.parentElement.classList.add('is-filled')
      //
      //     var now = new Date().toISOString().slice(0, 10);
      //     start_date.removeAttribute("disabled");
      //     start_date.type = 'date'
      //     start_date.value = now
      //     start_date.parentElement.classList.add('is-filled')
      //
      //     var next = new Date().addMonths(1).toISOString().slice(0, 10);
      //     end_date.removeAttribute("disabled");
      //     end_date.type = 'date'
      //     end_date.value = next
      //     end_date.parentElement.classList.add('is-filled')
      //
      //     submitBtn.removeAttribute("disabled");
      //
      //     alert_minutes_before.removeAttribute("disabled");
      // }

      const mainCities = new Map([
          ["Tokyo",["35.6839","139.7744"]],
          ["Jakarta",["-6.2146","106.8451"]],
          ["Manila",["14.6","120.9833"]],
          ["Seoul",["37.56","126.99"]],
          ["Mexico City",["19.4333","-99.1333"]],
          ["Cairo",["30.0444","31.2358"]],
          ["Beijing",["39.904","116.4075"]],
          ["Moscow",["55.7558","37.6178"]],
          ["Bangkok",["13.75","100.5167"]],
          ["Dhaka",["23.7289","90.3944"]],
          ["Buenos Aires",["-34.5997","-58.3819"]],
          ["Kinshasa",["-4.3317","15.3139"]],
          ["Tehran",["35.7","51.4167"]],
          ["London",["51.5072","-0.1275"]],
          ["Paris",["48.8566","2.3522"]],
          ["Lima",["-12.06","-77.0375"]],
          ["Luanda",["-8.8383","13.2344"]],
          ["Kuala Lumpur",["3.1478","101.6953"]],
          ["Hanoi",["21.0245","105.8412"]],
          ["Bogota",["4.6126","-74.0705"]],
          ["Dar es Salaam",["-6.8","39.2833"]],
          ["Hong Kong",["22.3069","114.1831"]],
          ["Santiago",["-33.45","-70.6667"]],
          ["Riyadh",["24.65","46.71"]],
          ["Baghdad",["33.35","44.4167"]],
          ["Khartoum",["15.6031","32.5265"]],
          ["Madrid",["40.4167","-3.7167"]],
          ["Nairobi",["-1.2864","36.8172"]],
          ["Rangoon",["16.795","96.16"]],
          ["Washington",["38.9047","-77.0163"]],
          ["Singapore",["1.3","103.8"]],
          ["Abidjan",["5.3364","-4.0267"]],
          ["Kabul",["34.5328","69.1658"]],
          ["Amman",["31.95","35.9333"]],
          ["Berlin",["52.5167","13.3833"]],
          ["Algiers",["36.7764","3.0586"]],
          ["Addis Ababa",["9.0272","38.7369"]],
          ["Brasilia",["-15.7939","-47.8828"]],
          ["Kuwait City",["29.375","47.98"]],
          ["Kyiv",["50.45","30.5236"]],
          ["Sanaa",["15.35","44.2"]],
          ["Guatemala City",["14.6099","-90.5252"]],
          ["Rome",["41.8931","12.4828"]],
          ["La Paz",["-16.4942","-68.1475"]],
          ["Pyongyang",["39.03","125.73"]],
          ["Antananarivo",["-18.9386","47.5214"]],
          ["Santo Domingo",["18.4764","-69.8933"]],
          ["Tashkent",["41.3","69.2667"]],
          ["Ouagadougou",["12.3686","-1.5275"]],
          ["Yaounde",["3.8578","11.5181"]],
          ["Accra",["5.6037","-0.187"]],
          ["Baku",["40.3667","49.8352"]],
          ["Harare",["-17.8292","31.0522"]],
          ["Havana",["23.1367","-82.3589"]],
          ["Phnom Penh",["11.5696","104.921"]],
          ["Mogadishu",["2.0408","45.3425"]],
          ["Bamako",["12.6458","-7.9922"]],
          ["Quito",["-0.22","-78.5125"]],
          ["Minsk",["53.9022","27.5618"]],
          ["Caracas",["10.5","-66.9333"]],
          ["Vienna",["48.2083","16.3725"]],
          ["Bucharest",["44.4","26.0833"]],
          ["Brazzaville",["-4.2667","15.2833"]],
          ["Warsaw",["52.23","21.0111"]],
          ["Damascus",["33.5131","36.2919"]],
          ["Brussels",["50.8353","4.3314"]],
          ["Lusaka",["-15.4167","28.2833"]],
          ["Budapest",["47.4983","19.0408"]],
          ["Conakry",["9.538","-13.6773"]],
          ["Kampala",["0.3136","32.5811"]],
          ["Abu Dhabi",["24.4511","54.3969"]],
          ["Muscat",["23.6139","58.5922"]],
          ["Ulaanbaatar",["47.9214","106.9055"]],
          ["Belgrade",["44.8167","20.4667"]],
          ["Prague",["50.0833","14.4167"]],
          ["Montevideo",["-34.8667","-56.1667"]],
          ["Sofia",["42.6979","23.3217"]],
          ["Abuja",["9.0556","7.4914"]],
          ["Maputo",["-25.9153","32.5764"]],
          ["Doha",["25.3","51.5333"]],
          ["Dakar",["14.7319","-17.4572"]],
          ["Nay Pyi Taw",["19.7475","96.115"]],
          ["Kigali",["-1.9536","30.0606"]],
          ["Tripoli",["32.8752","13.1875"]],
          ["Tegucigalpa",["14.0942","-87.2067"]],
          ["Tbilisi",["41.7225","44.7925"]],
          ["N'Djamena",["12.11","15.05"]],
          ["Copenhagen",["55.6805","12.5615"]],
          ["Yerevan",["40.1814","44.5144"]],
          ["Nur-Sultan",["51.1333","71.4333"]],
          ["Nouakchott",["18.0858","-15.9785"]],
          ["Bishkek",["42.8667","74.5667"]],
          ["Tunis",["36.8008","10.18"]],
          ["Kathmandu",["27.7167","85.3667"]],
          ["Niamey",["13.5086","2.1111"]],
          ["Managua",["12.15","-86.2667"]],
          ["Monrovia",["6.3106","-10.8047"]],
          ["Port-au-Prince",["18.5425","-72.3386"]],
          ["Islamabad",["33.6989","73.0369"]],
          ["Ottawa",["45.4247","-75.695"]],
          ["Stockholm",["59.3294","18.0686"]],
          ["Asmara",["15.3333","38.9167"]],
          ["Freetown",["8.4833","-13.2331"]],
          ["Vientiane",["17.9667","102.6"]],
          ["Jerusalem",["31.7833","35.2167"]],
          ["Bangui",["4.3732","18.5628"]],
          ["Panama City",["9","-79.5"]],
          ["Amsterdam",["52.3667","4.8833"]],
          ["Lome",["6.1319","1.2228"]],
          ["Libreville",["0.3901","9.4544"]],
          ["Zagreb",["45.8131","15.9772"]],
          ["Dushanbe",["38.5731","68.7864"]],
          ["Lilongwe",["-13.9833","33.7833"]],
          ["Cotonou",["6.402","2.518"]],
          ["Colombo",["6.9167","79.8333"]],
          ["Pretoria",["-25.7464","28.1881"]],
          ["Oslo",["59.9111","10.7528"]],
          ["Athens",["37.9842","23.7281"]],
          ["Bujumbura",["-3.3825","29.3611"]],
          ["Helsinki",["60.1756","24.9342"]],
          ["Skopje",["41.9833","21.4333"]],
          ["Chisinau",["47.0228","28.8353"]],
          ["Riga",["56.9475","24.1069"]],
          ["Kingston",["17.9714","-76.7931"]],
          ["Rabat",["34.0253","-6.8361"]],
          ["Vilnius",["54.6833","25.2833"]],
          ["San Salvador",["13.6989","-89.1914"]],
          ["Djibouti",["11.595","43.1481"]],
          ["Dublin",["53.3497","-6.2603"]],
          ["The Hague",["52.08","4.31"]],
          ["Asuncion",["-25.3","-57.6333"]],
          ["Lisbon",["38.708","-9.139"]],
          ["Bratislava",["48.1447","17.1128"]],
          ["Tallinn",["59.4372","24.745"]],
          ["Beirut",["33.8869","35.5131"]],
          ["Cape Town",["-33.925","18.425"]],
          ["Tirana",["41.33","19.82"]],
          ["Wellington",["-41.2889","174.7772"]],
          ["Dodoma",["-6.1835","35.746"]],
          ["Bissau",["11.8592","-15.5956"]],
          ["Canberra",["-35.2931","149.1269"]],
          ["Juba",["4.85","31.6"]],
          ["Yamoussoukro",["6.8161","-5.2742"]],
          ["Maseru",["-29.31","27.48"]],
          ["Nicosia",["35.1725","33.365"]],
          ["Windhoek",["-22.57","17.0836"]],
          ["Port Moresby",["-9.4789","147.1494"]],
          ["Porto-Novo",["6.4833","2.6167"]],
          ["Sucre",["-19.0431","-65.2592"]],
          ["San Jose",["9.9333","-84.0833"]],
          ["Ljubljana",["46.05","14.5167"]],
          ["Sarajevo",["43.8563","18.4132"]],
          ["Nassau",["25.0667","-77.3333"]],
          ["Bloemfontein",["-29.1","26.2167"]],
          ["Fort-de-France",["14.6104","-61.08"]],
          ["New Delhi",["28.6139","77.209"]],
          ["Gaborone",["-24.6569","25.9086"]],
          ["Paramaribo",["5.8667","-55.1667"]],
          ["Dili",["-8.5536","125.5783"]],
          ["Male",["4.175","73.5083"]],
          ["Georgetown",["6.7833","-58.1667"]],
          ["Gibraltar",["36.1324","-5.3781"]],
          ["Saint-Denis",["-20.8789","55.4481"]],
          ["Malabo",["3.7521","8.7737"]],
          ["Podgorica",["42.4397","19.2661"]],
          ["Manama",["26.225","50.5775"]],
          ["Port Louis",["-20.1667","57.5"]],
          ["Willemstad",["12.108","-68.935"]],
          ["Bern",["46.948","7.4474"]],
          ["Papeete",["-17.5334","-149.5667"]],
          ["Luxembourg",["49.6106","6.1328"]],
          ["Reykjavik",["64.1475","-21.935"]],
          ["Praia",["14.9177","-23.5092"]],
          ["Sri Jayewardenepura Kotte",["6.9","79.9164"]],
          ["Bridgetown",["13.0975","-59.6167"]],
          ["Moroni",["-11.7036","43.2536"]],
          ["Thimphu",["27.4833","89.6333"]],
          ["Mbabane",["-26.3208","31.1617"]],
          ["Noumea",["-22.2625","166.4443"]],
          ["Honiara",["-9.4333","159.95"]],
          ["Suva",["-18.1333","178.4333"]],
          ["Ankara",["39.93","32.85"]],
          ["Castries",["14.0167","-60.9833"]],
          ["Cayenne",["4.933","-52.33"]],
          ["Sao Tome",["0.3333","6.7333"]],
          ["Port-Vila",["-17.7333","168.3167"]],
          ["Hamilton",["32.2942","-64.7839"]],
          ["Bandar Seri Begawan",["4.9167","114.9167"]],
          ["Monaco",["43.7396","7.4069"]],
          ["Gitega",["-3.4283","29.925"]],
          ["Port of Spain",["10.6667","-61.5167"]],
          ["Apia",["-13.8333","-171.8333"]],
          ["Tarawa",["1.3382","173.0176"]],
          ["Oranjestad",["12.5186","-70.0358"]],
          ["Saint Helier",["49.1858","-2.11"]],
          ["Banjul",["13.4531","-16.5775"]],
          ["Mamoudzou",["-12.7871","45.275"]],
          ["Majuro",["7.0918","171.3802"]],
          ["Douglas",["54.15","-4.4819"]],
          ["George Town",["19.2866","-81.3744"]],
          ["Victoria",["-4.6236","55.4544"]],
          ["Kingstown",["13.1667","-61.2333"]],
          ["Andorra la Vella",["42.5","1.5"]],
          ["Saint John's",["17.1211","-61.8447"]],
          ["Nuku`alofa",["-21.1347","-175.2083"]],
          ["Ashgabat",["37.95","58.3833"]],
          ["Nuuk",["64.175","-51.7333"]],
          ["Belmopan",["17.25","-88.7675"]],
          ["Roseau",["15.3","-61.3833"]],
          ["Basseterre",["17.2983","-62.7342"]],
          ["Torshavn",["62","-6.7833"]],
          ["Pago Pago",["-14.274","-170.7046"]],
          ["Valletta",["35.8978","14.5125"]],
          ["Gaza",["31.5069","34.456"]],
          ["Grand Turk",["21.4664","-71.136"]],
          ["Palikir",["6.9178","158.185"]],
          ["Funafuti",["-8.5243","179.1942"]],
          ["Vaduz",["47.1397","9.5219"]],
          ["Lobamba",["-26.4465","31.2064"]],
          ["Avarua",["-21.207","-159.771"]],
          ["Saint George's",["12.0444","-61.7417"]],
          ["San Marino",["43.932","12.4484"]],
          ["Al Quds",["31.7764","35.2269"]],
          ["Capitol Hill",["15.2137","145.7546"]],
          ["Stanley",["-51.7","-57.85"]],
          ["Vatican City",["41.9033","12.4534"]],
          ["Alofi",["-19.056","-169.921"]],
          ["Basse-Terre",["16.0104","-61.7055"]],
          ["Hagta",["13.4745","144.7504"]],
          ["Marigot",["18.0706","-63.0847"]],
          ["Jamestown",["-15.9251","-5.7179"]],
          ["Brades",["16.7928","-62.2106"]],
          ["Philipsburg",["18.0256","-63.0492"]],
          ["Yaren",["-0.5477","166.9209"]],
          ["Pristina",["42.6633","21.1622"]],
          ["Gustavia",["17.8958","-62.8508"]],
          ["Road Town",["18.4167","-64.6167"]],
          ["Ngerulmud",["7.5006","134.6242"]],
          ["Saint-Pierre",["46.7811","-56.1764"]],
          ["The Valley",["18.2167","-63.05"]],
          ["Mata-Utu",["-13.2825","-176.1736"]],
          ["Kingston",["-29.0569","167.9617"]],
          ["Longyearbyen",["78.2167","15.6333"]],
          ["Tifariti",["26.0928","-10.6089"]],
          ["Adamstown",["-25.0667","-130.0833"]],
          ["Flying Fish Cove",["-10.4167","105.7167"]],
          ["King Edward Point",["-54.2833","-36.5"]],
          ["San Juan",["18.4037","-66.0636"]],
          ["Charlotte Amalie",["18.3419","-64.9332"]]
      ].sort());
  </script>

</body>

</html>
