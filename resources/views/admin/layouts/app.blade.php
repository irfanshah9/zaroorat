<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>test | Admin Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="{{ asset('global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/css/components-rounded.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('layouts/layout/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('layouts/layout/css/themes/default.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('layouts/layout/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('global/css/responsive.css') }}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
        <script src="{{ asset('global/plugins/jquery.min.js') }}"></script>
        <script src="{{ asset('global/scripts/app.min.js') }}"></script>
        <script src="{{ asset('global/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('global/plugins/js.cookie.min.js') }}"></script>
        <script src="{{ asset('global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"></script>
        <script src="{{ asset('global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('global/plugins/jquery.blockui.min.js') }}"></script>
        <script src="{{ asset('global/plugins/uniform/jquery.uniform.min.js') }}"></script>
        <script src="{{ asset('global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
        <script src="{{ asset('pages/scripts/common.js') }}"></script>
    </head>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <div class="page-logo">
<!--                    <a href="#">
                        <img  src="" alt="logo" class="logo-default" /> </a>-->
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <span class="username username-hide-on-mobile"> {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}} </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="{{ route('profile') }}">
                                        <i class="icon-lock"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}">
                                        <i class="icon-key"></i> Logout </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <?php //$modules = check_admin_modules_access(); ?>
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler"> </div>
                        </li>
                        <?php
                       // if (preg_grep("/Dashboard/i", $modules)) {
                            $active = '';
//                            if ($this->uri->segment(2) == 'Dashboard' || $this->uri->segment(2) == 'dashboard') {
//                                $active = 'active';
//                            }
                            ?>
                            <li class="nav-item custom start <?= $active; ?> open">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                     </ul>
                </div>
            </div>
            @yield('content')
        </div>
        <div class="page-footer">
            <div class="page-footer-inner"> 2018 © test by <a target="blank" href="https://www.purelogics.net/">PureLogics</a></div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <script src="{{ asset('global/plugins/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('pages/scripts/components-select2.min.js') }}"></script>
        <script src="{{ asset('layouts/layout/scripts/layout.min.js') }}"></script>
        <script src="{{ asset('layouts/layout/scripts/demo.min.js') }}"></script>
    </body>
</html>