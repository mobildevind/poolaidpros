<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="{{ route('admin.home') }}" class="logo" style="font-size: 19px;">

        <img src=" <?php echo asset('images/logo.png/'); ?>" style="width: 50px;" alt=""> 
        PoolAid Pros
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
            <a data-toggle="dropdown" class="dropdown-toggle" href="{{ route('admin.home') }}">
                <img src=" <?php echo asset('images/logo.png/'); ?>" style="width: 25px;" alt=""> 
                <span class="username">PoolAid Pros Admin</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">  
                <li><a href="{{route('changepassword.edit')}}"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="{{route('logout.add')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
        
    </ul>
    <!--search & user info end-->
</div>
</header>