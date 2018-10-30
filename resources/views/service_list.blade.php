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
                  <!--   <span class="tools pull-right">
                     </span> -->
                </header>
                <div class="panel-body static_page">
                    <div class="adv-table editable-table ">
                
                         <!-- <div class="clearfix">
                                <div class="btn-group">
                                    <a id="add_static_page" class="btn btn-primary" href="{{ route('add-service', ['id' => $id]) }}"> <i class="fa fa-plus"></i> Add New Service</a>
                                </div>                                
                            </div>   -->
                        <div class="space15"></div>
                        
                        <table data-ajax-url="{{ route('get_service_list_view', ['id' => $id]) }}" class="table table-striped table-hover table-bordered" id="editable-sample" data-order-type="DESC" data-order-cols="1">
                            <thead>
                                <tr>
                                        <th data-table-search="false" data-table-sort="true" data-name="DT_Row_Index" >ID</th>
                                       <!--   <th data-table-search="true" data-table-sort="true" data-name="name" >Service</th> -->
                                         <th data-table-search="true" data-table-sort="true" data-name="tec_id" >Technician</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="cus_id" >Customer</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="date" >Date</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="time" >Time</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="status" >Status</th>
                                        <th data-table-search="true" data-table-sort="true" data-name="report" >Service Technician Report</th>
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

             <!-- Popup model for report -->
            <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Technician Fill Report</h3>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
            <div class="row">
            <div class="col-md-4" style="height: 181px;"> 
            <h4 style="text-decoration: underline;text-transform: uppercase;">Chemistry</h4>
            <ul id="chemistry"></ul>
            </div>

            <div class="col-md-4"  style="height: 181px;"> 
            <h4 style="text-decoration: underline;text-transform: uppercase;"> Chemicals</h4>
            <ul id="chemicals"></ul>
            </div>

            <div class="col-md-4"  style="height: 181px;">  
            <h4 style="text-decoration: underline;text-transform: uppercase;">Cleaning</h4>
            <ul id="cleaning"></ul>
            </div>

        
            <div class="col-md-4"  style="height: 181px;">
            <h4 style="text-decoration: underline;text-transform: uppercase;">Cleaner</h4>
            <ul id="cleaner"></ul>
            </div>
            <div class="col-md-4"  style="height: 181px;">
            <h4 style="text-decoration: underline;text-transform: uppercase;"> Circulation</h4>
            <ul id="circulation"></ul>
            </div>
           
            <div class="col-md-4"  style="height: 181px;"> 
            <h4 style="text-decoration: underline;text-transform: uppercase;">Chemistry Report (Monthly) </h4>
            <ul id="chemistrymothly"></ul>
            </div>

                <div class="col-md-12" id="note" style="height: 181px;"> 
                </div>
            </div>

            </div>
            </div>

            <div class="modal-footer" style="border-top: 1px solid #36adda">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>

            <!-- Popup model for report -->
            <div class="modal fade" id="myModal_custom" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Technician Fill Report</h3>
            </div>
            <div class="modal-body">
            <div class="container-fluid">
            <div class="row" id="custome-rpt">
            </div>
            </div>
            </div>

            <div class="modal-footer" style="border-top: 1px solid #36adda">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
            </div>
            </div>
  

<!-- END JAVASCRIPTS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/data-tables/DT_bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap/js/bootstrap-toggle.min.js') }}"></script>

<script>
   jQuery(document).ready(function() {
    /*   $.getScript( "{{ asset('js/bootstrap/js/bootstrap-toggle.min.js') }}", function( data, textStatus, jqxhr ) {
            setTimeout(function () {
            $('input[name="status[]"]').bootstrapToggle();
        }, 100);
});*/
 jQuery('body').on('click','.dataview',function(e){

            var id = $(this).attr('data-id');
            var action = $(this).attr('data-action');

            if(action == 'dataview'){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('report_detail') }}",
                    data: {id: id, action: action},
                    success: function( msg ) {
                        var data = jQuery.parseJSON(msg);
                        $('#chemistry').html(data.Chemistry);
                        $('#chemicals').html(data.Chemicals);
                        $('#cleaning').html(data.Cleaning);
                        $('#circulation').html(data.circulation);
                        $('#chemistrymothly').html(data.Chemistrymothly);
                        $('#cleaner').html(data.Cleaner);
                        $('#note').html(data.note);

                        $('#myModal').modal('show');

                    }
                });
            }else  if(action == 'dataview_custom'){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('report_detail_custom') }}",
                    data: {id: id, action: action},
                    success: function( msg ) {
                       /* var data = jQuery.parseJSON(msg);
                        $('#chemistry').html(data.Chemistry);
                        $('#chemicals').html(data.Chemicals);
                        $('#cleaning').html(data.Cleaning);
                        $('#circulation').html(data.circulation);
                        $('#chemistrymothly').html(data.Chemistrymothly);
                        $('#cleaner').html(data.Cleaner);*/
                        
                        $('#custome-rpt').html(msg);
                        $('#myModal_custom').modal('show');

                    }
                });
            }
                      
      });
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
