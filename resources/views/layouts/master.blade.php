<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ThankCard</title>

        <!-- Fonts -->
         <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- Styles -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/font-awesome.min.css') }}">

        <link rel="stylesheet" type="text/css" media="screen"  href="{{ asset('css/smartadmin-production-plugins.min.css') }}"> 
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/smartadmin-production.min.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/smartadmin-skins.min.css') }}"> 
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/smartadmin-rtl.min.css') }} ">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
         <link rel="stylesheet" type="text/css" media="screen"  href="{{ asset('css/custom.css') }}"> 

        <!-- End Styles -->
    </head>
    <body class="smart-style-2 desktop-detected menu-on-top">
        <header id="header"> 
             <div id="logo-group">
                <span id="logo"> <img src="{{ asset('img/giftcard.png') }}" alt="WeitSein" style="width:40%;"> </span>
            </div>
            <div class="pull-right">
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
                    class="fa fa-reorder"></i></a> </span>
                </div>
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <span class="label"><strong>Su Nandar Htay</strong></span>
                    <li class="">
                        <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                            <img src="{{ asset('img/avatars/female.png') }}" alt="User" class="online"/>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i
                                        class="fa fa-cog"></i> Setting</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i
                                        class="fa fa-user"></i> <u>P</u>rofile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{url('logout')}}"
                                   class="padding-10 padding-top-5 padding-bottom-5"
                                   data-action="userLogout"><i
                                        class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div id="logout" class="btn-header transparent pull-right">
                    <span>
                        <a href="#" title="Sign Out"
                           data-action="userLogout"
                           data-logout-msg="You can improve your security further after logging out by closing this opened browser">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </span>
                </div>
            </div>
        </header> 
        <aside id="left-panel"> 
            <nav style="margin:0 200px;width:auto;">
                <ul> 
                    @php
                        $menus=\Session::get('Authorities'); 
                        App\Helper::PRINTMENU($menus);
                    @endphp 
                </ul>
            </nav> 
        </aside> 
        <div id="main" role="main">
            <div id="content" style="opacity: 1;">
                @yield('content')
            </div>
        </div>      
    </body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.config.js') }}"></script>
    <script src="{{ asset('js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/notification/SmartNotification.min.js') }}"></script> 
    <script src="{{ asset('js/smartwidgets/jarvis.widget.min.js')}}"></script>
    <script src="{{ asset('js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')}}"></script>
    <script src="{{ asset('js/plugin/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>
    <script src="{{ asset('js/plugin/select2/select2.min.js')}}"></script>
    <script src="{{ asset('js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>
    <script src="{{ asset('js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>
    <script src="{{ asset('js/plugin/fastclick/fastclick.min.js')}}"></script> 
    <script src="{{ asset('js/app.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
  $('#dtBasicExample').DataTable({
    "paging": true ,// false to disable pagination (or any other option)
    "iDisplayLength": 5,
    "searching": true
  });
  $('.dataTables_length').addClass('bs-select');
});
    </script>   
</html>
