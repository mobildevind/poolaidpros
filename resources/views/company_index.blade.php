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
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #65acc7 !important;    border-color: #65acc7 !important;">Service technicians</span>
                       
                         <a href="{{ route('add-technician', ['id' => $id]) }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #65acc7 !important;    border-color: #65acc7 !important;">+ Technician</a>
                    </div>
                    <a href="{{ route('get_company_technicians_list', ['id' => $id]) }}">
                    <span class="mini-stat-icon tar"><i class="fa fa-users" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $technician; ?></span>
                       Service technicians
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;">Active Customers</span>
                        
                         <a href="{{ route('add-user', ['id' => $id]) }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;">+ Customers</a>
                    </div>
                     <a href="{{ route('get_companyuser_list', ['id' => $id]) }}">
                    <span class="mini-stat-icon pink"><i class="fa fa-users" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $users; ?></span>
                       Active Customers
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #aec785 !important;    border-color: #aec785 !important;">Tutorials</span>
                       
                         <a href="{{ route('company_tutorial', ['id' => $id]) }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #aec785 !important;    border-color: #aec785 !important;"><i class="fa fa-eye"></i>  View</a>
                    </div>
                     <a href="{{ route('company_tutorial', ['id' => $id]) }}">
                    <span class="mini-stat-icon green"><i class="fa fa-book" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $tutorials; ?></span>
                        Tutorials
                    </div>
                    </a>
                </div>
            </div>
             <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;">Active Members</span>
                        
                         <a href="{{ route('add-employe', ['id' => $id]) }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;">+ Member</a>
                    </div>
                     <a href="{{ route('get_cemploye_list', ['id' => $id]) }}">
                    <span class="mini-stat-icon pink"><i class="fa fa-users" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $employe; ?></span>
                       Active Members
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;">Service Request</span>
                        
                         <a href="{{ route('service', ['id' => $id]) }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #a48ad4 !important;    border-color: #a48ad4 !important;"><i class="fa fa-eye"></i>  View</a>
                    </div>
                     <a href="{{ route('service', ['id' => $id]) }}">
                    <span class="mini-stat-icon pink"><i class="fa fa-user" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span><?php echo $service; ?></span>
                        Service Request
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mini-stat clearfix">
                 <div class="tile-heading" style=" padding-bottom: 14px;">
                        <span class="titlemd" ng-click="vm.goto('#/customers/filter/active')" style="color: #aec785 !important;    border-color: #aec785 !important;">Subscription Detail</span>
                        
                     <!--     <a href="{{ route('add-company') }}" class="btn btn-orange-alt btn-sm" title="New Customer" style="color: #aec785 !important;    border-color: #aec785 !important;">+ service request</a> -->
                    </div>
                    <span class="mini-stat-icon green"><i class="fa fa-user" style="line-height: 2;"></i></span>
                    <div class="mini-stat-info">
                        <span style="font-size: 13px;">Name : Gold </span>
                        <span style="font-size: 13px;">Amount : 2000 </span>
                        <span style="font-size: 13px;">Expiry date : 26/10/2018 </span>
                    </div>
                </div>
            </div>
        </div>
        <!--mini statistics end-->


        
    </section>
</section>
<!--main content end-->
@stop






