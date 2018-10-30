<aside>
   
    <div id="sidebar" class="nav-collapse" data-attr>
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <!--                <li>
                                    <a class="">
                                        <i class="fa fa-dashboard"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>-->
                <li class="sub-menu" >
                    <a href="{{ route('vendor.quote_request') }}" class="{{ Route::currentRouteName() == 'vendor.quote_request' ? 'active' : '' }}" >
                        <i class="fa fa-laptop"></i>
                        Quote Requests
                    </a>
                </li>
            
            </ul> 
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>