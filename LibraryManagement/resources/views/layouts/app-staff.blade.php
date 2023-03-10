<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="..\images\favicon.ico">

    @yield('styles')

    <!-- Bootstrap Css -->
    <link href="..\css\bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css">
    <!-- Icons Css -->
    <link href="..\css\icons.min.css" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="..\css\app.min.css" id="app-style" rel="stylesheet" type="text/css">

    <!-- CSS And JavaScript -->
</head>

<body data-sidebar="dark">
    <div class="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{ route('dashboard') }}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="..\images\logo.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="..\images\logo-dark.png" alt="" height="17">
                            </span>
                        </a>

                        <a href="{{ route('dashboard') }}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="..\images\logo-light.svg" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="..\images\logo-light.png" alt="" height="19">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="..\images\users\avatar-1.jpg" alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ml-1">Henry</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>
                            <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                            <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar="" class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="{{ route('home') }}" class="waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span>Trang chủ</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('loancard.index') }}" class="waves-effect">
                                <i class="bx bxs-card"></i>
                                <span>Quản lý thẻ mượn</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('type.index') }}" class="waves-effect">
                                <i class="bx bxs-book"></i>
                                <span>Quản lý thể loại</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('book.index') }}" class="waves-effect">
                                <i class="bx bxs-book"></i>
                                <span>Quản lý sách</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reader.index') }}" class="waves-effect">
                                <i class="bx bxs-book"></i>
                                <span>Quản lý đọc giả</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('staff.change-password') }}" class=" waves-effect">
                                <i class="bx bx-lock"></i>
                                <span>Đổi mật khẩu</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        @yield('content')
    </div>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="..\libs\jquery\jquery.min.js"></script>
    <script src="..\libs\bootstrap\js\bootstrap.bundle.min.js"></script>
    <script src="..\libs\metismenu\metisMenu.min.js"></script>
    <script src="..\libs\simplebar\simplebar.min.js"></script>
    <script src="..\libs\node-waves\waves.min.js"></script>

    @stack('scripts')

</body>

</html>
