<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ThankCard</title>
        <!--Favicon -->
        <link rel="icon" href="{{ URL::asset('img/favicon.png') }}" type="image/x-icon"/>
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
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/smartadmin-rtl.min.css') }} ">
        <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/dataTables.bootstrap4.min.css') }} "> 
        <link rel="stylesheet" type="text/css" media="screen"  href="{{ asset('css/custom.css') }}"> 
        <!-- <link rel="stylesheet" type="text/css" media="screen"  href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">  -->
        <!-- End Styles -->
    </head>
    <body class="smart-style-2 desktop-detected menu-on-top">
        <header id="header"> 
             <div id="logo-group">
                <span id="logo"> <img src="{{ asset('img/logo.png') }}" alt="WeitSein" style="width:40%;"> </span>
            </div>
            <div class="pull-right">
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i
                    class="fa fa-reorder"></i></a> </span>
                </div>
                <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                    <span class="label" style="font-size:12px;"><strong>{{App\Helper::UserName()}}</strong></span>
                    <li class="">
                      
                            <img src="{{ asset('img/avatars/female.png') }}" alt="User" class="online"/>
                            
                        </a>
                        <ul class="dropdown-menu pull-right"> 
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
    <script src="{{ asset('js/jquery/jquery-2.1.1.min.js') }}" ></script>
    <script src="{{ asset('js/app.config.js') }}"></script>
    <script src="{{ asset('js/plugin/jquery-touch/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script> 
    <script src="{{ asset('js/jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/jquery/dataTables.bootstrap4.min.js') }}"></script>
    
    <script src="{{ asset('js/app.min.js')}}"></script>  
    <script type="text/javascript">
        $(document).ready(function () { 
            $('#dtBasicExample').DataTable({
                "paging": true ,// false to disable pagination (or any other option)
                "iDisplayLength": 5,
                "searching": true
            });
            $('.dataTables_length').addClass('bs-select');
            });
            $('#dtThankCard').DataTable({
                "paging": true ,// false to disable pagination (or any other option)
                "iDisplayLength": 5,
                "searching": false,
                "bLengthChange": false
            }); 
            // set current date
            setCurrentDate();
           function setCurrentDate(){ 
                var today = new Date(); 
                date =today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2)
                       + '-' + ('0' + today.getDate()).slice(-2);
                document.getElementById("from_date").value = date;
                document.getElementById("to_date").value = date; 

                from_date="<?php echo Request::old('from_date');?>";
                to_date  ="<?php echo Request::old('to_date');?>"; 

                if(from_date){
                    document.getElementById("from_date").value = from_date;
                }else{
                    document.getElementById("from_date").value = date;
                }
                if(to_date){
                    document.getElementById("to_date").value = to_date;
                }else{
                    document.getElementById("to_date").value = date;
                }
                
           }
    </script>   
</html> 