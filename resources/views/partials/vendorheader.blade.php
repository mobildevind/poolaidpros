<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">

        <meta http-equiv=”X-UA-Compatible” content=”IE=EmulateIE9”>
        <meta http-equiv=”X-UA-Compatible” content=”IE=9”>

        <link rel="shortcut icon" href="images/favicon.png">
        <title>@yield('title', $title)</title>
        <!--Core CSS -->
        <link href="/bs3/css/bootstrap.min.css" rel="stylesheet">
        <link href="/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
        <link href="/css/bootstrap-reset.css" rel="stylesheet">
        <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="/js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
        <link href="/css/clndr.css" rel="stylesheet">
        <!--clock css-->
        <link href="/js/css3clock/css/style.css" rel="stylesheet">
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="/js/morris-chart/morris.css">
            <link href="/js/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />

        <link rel="stylesheet" href="/js/data-tables/DT_bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
        <!-- Custom styles for this template -->
        <link href="/css/style.css" rel="stylesheet">
        <link href="/css/style-responsive.css" rel="stylesheet"/>
        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]>
        <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="{{ ($is_rtl == 'true')?'custom_rtl':'' }}">
        <section id="container">
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="index.html" class="logo">
        <img src="/images/logo.png" alt="">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->

        <!-- settings end -->

        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
       
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{ Session::get('image') }}">
                <span class="username">{{ Session::get('vendor_user_name') }}</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="/vendor/edit_profile"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="/vendor/change_password_view"><i class="fa fa-cog"></i> Change Password</a></li>
                <li><a href="/vendor/change_password_view"><i class="fa fa-calendar"></i> My Availability</a></li>
                <li><a href="/vendor/logout"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
    </ul>
    <!--search & user info end-->
</div>
</header>