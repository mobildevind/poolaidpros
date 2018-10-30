@extends('include-inner.main')

@section('content')
<section id="main-content">
    <section class="wrapper">
        @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="color:orangered">{{ Session::get('message') }}</p>
        @endif
        <!--mini statistics start-->
      
        <!--mini statistics start-->
        <div class="row">
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #fa8564 !important;    border-color: #fa8564 !important;">Companies</span>
                        
                         <a href="{{ route('add-company') }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #fa8564 !important;    border-color: #fa8564 !important;">+ Company</a>
                    </div>
                       <a href="{{ route('get_company_list') }}">
                    <span class="mini-stat-icon orange"><i class="fa fa-building-o" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info" style="font-size: 11px">
                        <span><?php echo $company; ?></span>
                        Active Companies

                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #65acc7 !important;    border-color: #65acc7 !important;">Technicians</span>
                          <a href="{{ route('admin.cadd-technician') }}" class="btn btn-orange-alt btn-sm" title="New Technicians" style="color: #65acc7 !important;    border-color: #65acc7 !important;">+ Technician</a>
                    </div>
                    <a href="{{ route('get_technicians_list') }}">
                    <span class="mini-stat-icon tar"><i class="fa fa-users" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $technitian; ?></span>
                       Service technicians
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;">Customer</span>
                         <a href="{{ route('admin.uadd-cuser') }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;">+ Customer</a>
                    </div>
                    <a href="{{ route('get_user_list') }}">  
                    <span class="mini-stat-icon pink"><i class="fa fa-users" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $users; ?></span>
                       Customers
                    </div>
                    </a>
                </div>
            </div>
             <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #65acc7 !important;    border-color: #65acc7 !important;">Company Members</span>
                          <a href="{{ route('admin.uadd-employe') }}" class="btn btn-orange-alt btn-sm" title="New Member" style="color: #65acc7 !important;    border-color: #65acc7 !important;">+ Member</a>
                    </div>
                    <a href="{{ route('get_employe_list') }}">
                    <span class="mini-stat-icon tar"><i class="fa fa-users" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $employe; ?></span>
                       Company Member
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #aec785 !important;    border-color: #aec785 !important;">Tutorials</span>
                         <a href="{{ route('admin.add-tutorial') }}" class="btn btn-orange-alt btn-sm" title="New Tutorial" style="color: #aec785 !important;    border-color: #aec785 !important;">+ Tutorial</a>
                    </div>
                     <a href="{{ route('tutorial') }}">
                    <span class="mini-stat-icon green"><i class="fa fa-book" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $tutorials; ?></span>
                        Tutorials
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <!--mini statistics end-->


        
    </section>
</section>
<!--main content end-->
@stop






