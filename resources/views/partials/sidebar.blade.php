        <aside>

        <div id="sidebar" class="nav-collapse" data-attr>
        <!-- sidebar menu start-->
        <!-- Start Admin Sidebar -->

        <div class="leftside-navigation">
        <ul class="sidebar-menu" id="nav-accordion">
        <?php  $prefix = trans('constant.prefix'); ?>

      <!--   <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>"><a href="{{ route('get_company_list')}}" class="{{ Route::currentRouteName() == 'get_company_list' || Route::currentRouteName() == 'view_company' || Route::currentRouteName() == 'edit_company' || Route::currentRouteName() == 'add-company' ? 'activesubclass' : '' }} "><i class="fa fa-building-o"></i> Manage Company 
        <span id="count_req" class="badge" style="background-color: red;"></span></a></li>
 -->
         <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>">
        <a href="#" class="{{ Route::currentRouteName() == 'get_company_list' || Route::currentRouteName() == 'view_employe'  || Route::currentRouteName() == 'view_company' || Route::currentRouteName() == 'get_employe_list' || Route::currentRouteName() == 'admin.uadd-employe' || Route::currentRouteName() == 'edit_company' ||  Route::currentRouteName() == 'edit_employe'  || Route::currentRouteName() == 'add-company' ? 'active' : '' }}"><i class="fa fa-building-o"></i> Manage Company 
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
         <ul class="sub">
            <li><a href="{{ route('get_company_list')}}" class="{{ Route::currentRouteName() == 'get_company_list' || Route::currentRouteName() == 'view_company' || Route::currentRouteName() == 'edit_company' || Route::currentRouteName() == 'add-company' ? 'activesubclass' : '' }}">Company</a></li>

            <li><a href="{{ route('get_employe_list')}}" class="{{ Route::currentRouteName() == 'view_employe' ? 'activesubclass' : '' }} {{ Route::currentRouteName() == 'get_employe_list' ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'admin.uadd-employe' ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'edit_employe' ? 'activesubclass' : '' }}"> Company Member</a></li>
        </ul> 
        </li>

        <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>"><a href="{{ route('get_technicians_list')}}" class="{{ Route::currentRouteName() == 'get_technicians_list'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'edit_tecnician'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'admin.cadd-technician'   ? 'activesubclass' : '' }}"><i class="fa fa-user"></i> Technicians
        <span id="count_req" class="badge" style="background-color: red;"></span></a></li>



        <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>"><a href="{{ route('get_user_list')}}" class="{{ Route::currentRouteName() == 'get_user_list'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'admin.uadd-cuser'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'edit_user'   ? 'activesubclass' : '' }}"><i class="fa fa-users"></i>Customers
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        </li>

       
        <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>"><a href="{{route('subscription_plan_list')}}" class="{{ Route::currentRouteName() == 'edit_subscription'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'subscription_plan_list'   ? 'activesubclass' : '' }} {{ Route::currentRouteName() == 'add-subscription'   ? 'activesubclass' : '' }}"><i class="fa fa-users"></i> Subscription Plan
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        </li>
        <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>"><a href="{{route('equipment_list')}}" class="{{ Route::currentRouteName() == 'equipment_list'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'add-equipment'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'edit_equipment'   ? 'activesubclass' : '' }}"><i class="fa fa-users"></i> Equipment
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        </li>
          <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>"><a href="{{ route('get_user_list')}}" class="{{ Route::currentRouteName() == 'tutorial_catagory'   ? 'active' : '' }}{{ Route::currentRouteName() == 'edit-tutorial'   ? 'active' : '' }}{{ Route::currentRouteName() == 'add-tutorial'   ? 'active' : '' }} {{ Route::currentRouteName() == 'tutorial'   ? 'active' : '' }}{{ Route::currentRouteName() == 'tutorial_view'   ? 'active' : '' }}{{ Route::currentRouteName() == 'admin.add-tutorial'   ? 'active' : '' }}{{ Route::currentRouteName() == 'edit-ututorial'   ? 'active' : '' }}"><i class="fa fa-book"></i> Tutorials
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
         <ul class="sub">
            <li><a href="{{ route('tutorial_catagory')}}" class="{{ Route::currentRouteName() == 'tutorial_catagory'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'edit-tutorial'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'add-tutorial'   ? 'activesubclass' : '' }}">Tutorials Category</a></li>

            <li><a href="{{ route('tutorial')}}" class="{{ Route::currentRouteName() == 'tutorial'   ? 'activesubclass' : '' }} {{ Route::currentRouteName() == 'tutorial_view'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'edit-ututorial'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'admin.add-tutorial'   ? 'activesubclass' : '' }}"> Tutorial Videos</a></li>
        </ul> 
        </li>
        <li style="display:<?php
        if(isset($id) AND ($prefix != '/admin')){ echo "none"; } else {  echo "block"; } ?>"><a href="{{ route('report')}}" class="{{ Route::currentRouteName() == 'report'   ? 'active' : '' }}
        {{ Route::currentRouteName() == 'customer_report'   ? 'active' : '' }}{{ Route::currentRouteName() == 'technicians_report'   ? 'active' : '' }}{{ Route::currentRouteName() == 'request_report'   ? 'active' : '' }}"><i class="fa fa-flag" aria-hidden="true"></i> Reports
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        <ul class="sub">
            <li><a href="{{ route('report')}}" class="{{ Route::currentRouteName() == 'report'   ? 'activesubclass' : '' }}">Company Report</a></li>
            <li><a href="{{ route('customer_report')}}" class="{{ Route::currentRouteName() == 'customer_report'   ? 'activesubclass' : '' }}">Company Customers Report</a></li>
            <li><a href="{{ route('technicians_report')}}" class="{{ Route::currentRouteName() == 'technicians_report'   ? 'activesubclass' : '' }}">Company Service Technicians Report</a></li>
            <li><a href="{{ route('request_report')}}" class="{{ Route::currentRouteName() == 'request_report'   ? 'activesubclass' : '' }}">Company Service Requests Report</a></li>
            <li><a href="#" class="">Earning report</a></li>
        </ul> 
        </li>
       
        <!-- End Admin Sidebar -->
        <!-- Company Sidebar start -->

        <li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id; echo "block"; } else { $userid = ''; echo "none"; } ?>">
        <?php if($userid != ''){ ?>
        <a href="javascript:void(0)" class="javascript:void(0)">
        <?php 
        $detail = DB::table('users as u')
        ->select('u.id as userid','u.first_name','u.last_name','u.user_name','u.email','u.country_code','u.mobile','c.id','c.name','c.email as personemail','c.country_code as pcode','c.phone','u.is_active','c.address')
        ->join('company as c', 'c.u_id', '=', 'u.id')
        ->where('u.id',$userid)->get()->first();
        ?>
        <div class="info ng-scope" ng-if="!userinfo._getUserImage()" style="padding: 0px;">
        <span class="username ng-binding" style="font-size: 15px;
        line-height: 24px;
        color: #cfd8dc;"><?php echo $detail->name ?></span>
        <span class="useremail ng-binding" style="font-size: 12px;
        line-height: 1.35;    color: #546e7a;"><?php echo $detail->personemail ?></span>
        </div>
        </a>
        <?php } ?>
        </li>

        <li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id; echo "block"; } else { $userid = ''; echo "none"; } ?>"><a href="{{ route('index', ['id' => $userid]) }}" class="{{ Route::currentRouteName() == 'index'   ? 'activesubclass' : '' }}"><i class="fa fa-tachometer"></i>Dashboard 
        <span id="count_req" class="badge" style="background-color: red;"></span></a></li>
        <li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id; echo "block"; } else { $userid = ''; echo "none"; } ?>"><a href="{{ route('edit_perticular_company', ['id' => $userid]) }}" class="{{ Route::currentRouteName() == 'edit_perticular_company'   ? 'activesubclass' : '' }}"><i class="fa fa-building-o" ></i> Company Details
        <span id="count_req" class="badge" style="background-color: red;"></span></a>

        </li>
<li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id;echo "block"; } else { $userid = ''; echo "none";}
        ?>"><a href="{{ route('get_cemploye_list', ['id' => $userid]) }}" class="{{ Route::currentRouteName() == 'get_cemploye_list'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'add-employe'   ? 'activesubclass' : '' }} {{ Route::currentRouteName() == 'view_employe'   ? 'activesubclass' : '' }} {{ Route::currentRouteName() == 'add-user'   ? 'activesubclass' : '' }}"><i class="fa fa-users"></i> Member
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        </li>
        <li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id; echo "block"; } else { $userid = ''; echo "none"; } ?>"><a href="{{ route('get_company_technicians_list', ['id' => $userid]) }}" class="{{ Route::currentRouteName() == 'get_company_technicians_list'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'add-technician'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'view_technician'   ? 'activesubclass' : '' }}"><i class="fa fa-user"></i> Technicians
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        </li>
        
         

        <li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id;echo "block"; } else { $userid = ''; echo "none";}
        ?>"><a href="{{ route('get_companyuser_list', ['id' => $userid]) }}" class="{{ Route::currentRouteName() == 'get_companyuser_list'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'add-user'   ? 'activesubclass' : '' }}{{ Route::currentRouteName() == 'view_user'   ? 'activesubclass' : '' }}"><i class="fa fa-users"></i> Customer
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        </li>

       <li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id;echo "block"; } else { $userid = ''; echo "none";}
        ?>"><a href="{{ route('company_tutorial', ['id' => $userid]) }}" class="{{ Route::currentRouteName() == 'company_tutorial'   ? 'activesubclass' : '' }} {{ Route::currentRouteName() == 'company_tutorial_view'   ? 'activesubclass' : '' }}"><i class="fa fa-book"></i> Tutorial Videos
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
        </li>

        <li style="display:<?php
        if(isset($id) AND ($prefix == '/company')){ $userid = $id;echo "block"; } else { $userid = ''; echo "none";}
        ?>"><a href="{{ route('service', ['id' => $userid]) }}" class="{{ Route::currentRouteName() == 'service'   ? 'activesubclass' : '' }}"><i class="fa fa-users"></i> Service Request
        <span id="count_req" class="badge" style="background-color: red;"></span></a>
       <!--  <ul class="sub">
            <li><a href="{{ route('service_catagory', ['id' => $userid]) }}" class=""><i class="fa fa-circle-o"></i> Category</a></li>

            <li><a href="{{ route('service', ['id' => $userid]) }}" class=""><i class="fa fa-circle-o"></i> Services</a></li>
        </ul>  -->
        </li>


        <!-- End Company Sidebar start -->

        



        </ul> 
        </div>
        <!-- sidebar menu end-->
        </div>
        </aside>
