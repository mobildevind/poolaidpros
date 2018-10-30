@extends('include-inner.main')

@section('content')
<link rel="stylesheet" href="{{ asset('js/data-tables/DT_bootstrap.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />

<section id="main-content">
    <section class="wrapper">
    <!-- page start-->
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                   <?php echo  $title; ?>
                 <!--    <span class="tools pull-right">
                     </span> -->
                </header>
                <div class="panel-body static_page">


                    <div class="adv-table editable-table ">
                
                <div class="clearfix">
                             
                                    <a id="add_static_page" class="btn btn-primary" href="{{ route('admin.cadd-technician') }}" style="    float: right;"> <i class="fa fa-plus"></i> Add New Technician</a>
                         
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                               
                                    <div class="col-lg-3 date-input-custom">
                                    <select class="form-control" name="search_company" id="search_company" ng-model="vm.employee.salary_recurrency">
                                    <option value="">Search Company</option>
                                    <?php foreach ($company_list as $key => $value) { ?>
                                        
                                    
                                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                    <?php } ?>
                                    </select>
                                     <!-- <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{@date('Y-m-d')}}"  class="input-append date date">
                                            <input type="text" readonly="" name="start" placeholder="From" id="start" value="" size="16" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div> -->
                                       
                                    </div>
                                 


                                     <div class="col-lg-2 custom_report_date_save">
                                        <input type="button"  id="report-search-form" name="submit" value="search" class="btn btn-primary btn-red">
                                       <!--  <input type="button"  id="clear" name="" value="clear" class="btn btn-primary btn-yellow"> -->
                                    </div>
                                   

                                </div>
                            <!--      <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Add</button>
                                            <a href="" class="btn btn-warning">Back</a>
                                        </div> 
                                    </div>  
 -->                           
                                                  
                            </div>  
                        
               
                        <div class="space15"></div>
                       <?php if(isset($id)){ ?>
                       <table data-ajax-url="{{ route('get_companytechnicians_list_view', ['id' => $id]) }}" class="table table-striped table-hover table-bordered" id="editable-sample" data-order-type="DESC" data-order-cols="1">
                        <?php }else{ ?>
                        <table data-ajax-url="{{ route('get_technicians_list_view') }}" class="table table-striped table-hover table-bordered" id="editable-sample" data-order-type="DESC" data-order-cols="1">
                        <?php } ?>
                            <thead>
                                <tr>
                                        <th data-table-search="false" data-table-sort="true" data-name="DT_Row_Index" >ID</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="image" >Technician Photo</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="Company" >Company</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="first_name" >Technician Name</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="mobile" >Phone</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="email" >Email</th>
                                         <th data-table-search="false" data-table-sort="true" data-name="status" >status</th>
                                        <th data-table-search="false" data-table-sort="true" data-name="action" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- page end-->
    </section>
</section>

<!-- END JAVASCRIPTS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/data-tables/DT_bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap/js/bootstrap-toggle.min.js') }}"></script>
<script>
   jQuery(document).ready(function() {
 /*     $.getScript( "{{ asset('js/bootstrap/js/bootstrap-toggle.min.js') }}", function( data, textStatus, jqxhr ) {
            setTimeout(function () {
            $('input[name="status[]"]').bootstrapToggle();
        }, 100);
});*/
        jQuery('#editable-sample').on('change', 'input.status_toggle_class', function(e){
            e.preventDefault();
            e.stopPropagation();
            
            var id = $(this).attr('data-id');
            if($(this).is(':checked')){
                var status = 'Y'
            } else {
                var status = 'N'
            }

            var result = confirm("Are you sure you want to do this?");
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('UpdateStatus') }}",
                    data: {id: id, status: status},
                    success: function( msg ) {
                    location.reload();
                    }
                });
            }
            else {
                if($(this).is(':checked')){
                    $(this).attr('checked',true);
                }else{
                    $(this).attr('checked',false);
                }
                return true;
            }
        });
    });
    
</script>
<script>
    jQuery(document).ready(function() {
        EditableTable.init();
        $('body').on('click','.catdelete',function(){
            confirm("You want to delete this skill");            
        });

        var table = $('#editable-sample').DataTable();
    });
</script>
@stop
