<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/preloader.css">
        <link rel="stylesheet" href="assets/css/dashboard.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .active{
            background:#fff;
            border-radius: 25px 0px 0px 25px;
            }
    </style>
    </head>
    <body>
    <div class="loader_bg">
	    <div class="loader"><img src="{{asset('assets/img/Spinner.gif')}}"></div>
    </div>
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </div>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="{{ Request::path()==='home' ? 'active nav-link text-dark' : 'nav-link' }}" href="{{ route('home') }}">
                <i class="{{ Request::path()==='home' ? 'fa fa-tachometer text-dark' : 'fa fa-tachometer' }}" aria-hidden="true"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="{{ Request::path()==='application-list' ? 'active nav-link text-dark' : 'nav-link' }}" href="{{url('application-list')}}">
                <i class="{{ Request::path()==='application-list' ? 'fa fa-list text-dark' : 'fa fa-list' }}" aria-hidden="true"></i>
                    <span>Applications</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="{{ Request::path()==='education-list' ? 'active nav-link text-dark' : 'nav-link' }}" href="{{url('education-list')}}">
                <i class="{{ Request::path()==='education-list' ? 'fa fa-list text-dark' : 'fa fa-list' }}" aria-hidden="true"></i>
                    <span>Education Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Request::path()==='marriage-list' ? 'active nav-link text-dark' : 'nav-link' }}" href="{{url('marriage-list')}}">
                    <i class="{{ Request::path()==='marriage-list' ? 'fa fa-list text-dark' : 'fa fa-list' }}" aria-hidden="true"></i>
                    <span>Marriage Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Request::path()==='treatment-list' ? 'active nav-link text-dark' : 'nav-link' }}" href="{{url('treatment-list')}}">
                    <i class="{{ Request::path()==='treatment-list' ? 'fa fa-list text-dark' : 'fa fa-list' }}" aria-hidden="true"></i>
                    <span>Treatment Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="{{ Request::path()==='other-list' ? 'active nav-link text-dark' : 'nav-link' }}" href="{{url('other-list')}}">
                    <i class="{{ Request::path()==='other-list' ? 'fa fa-list text-dark' : 'fa fa-list' }}" aria-hidden="true"></i>
                    <span>Other Applications</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="{{ Request::path()==='slide-list' ? 'active nav-link text-dark' : 'nav-link' }}" href="{{url('slide-list')}}">
                    <i class="{{ Request::path()==='slide-list' ? 'fa fa-list text-dark' : 'fa fa-list' }}" aria-hidden="true"></i>
                    <span>Slides</span>
                </a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" id="userDropdown" role="button"
                             data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">   
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu ms-auto shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('password.change') }}">
                                    <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off text-gray-400 mr-2" aria-hidden="true"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                @yield('content')
            </div>
        </div>
    </div>

 

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @yield('scripts')
    <script>
        setTimeout(function()  {
            $('.loader_bg').fadeOut(500);
        }, 1000);
    </script>
    </body>
</html>