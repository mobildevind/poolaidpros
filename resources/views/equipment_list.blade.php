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
                                <div class="btn-group">
                                    <a id="add_static_page" class="btn btn-primary" href="{{ route('add-equipment') }}"> <i class="fa fa-plus"></i> Add New Equipment</a>
                                </div>                                
                            </div>  
                        <div class="space15"></div>
                        
                        <table data-ajax-url="{{ route('get_equipment_list') }}" class="table table-striped table-hover table-bordered" id="editable-sample" data-order-type="DESC" data-order-cols="1">
                            <thead>
                                <tr>
                                <th data-table-search="false" data-table-sort="true" data-name="DT_Row_Index" >ID</th>

                                    <th data-table-search="true" data-table-sort="true" data-name="name" >Name</th>
                                    <th data-table-search="true" data-table-sort="true" data-name="photo" >Photo</th>
                                    <th data-table-search="true" data-table-sort="true" data-name="description" >Description</th>
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
<!-- <script type="text/javascript" src="{{ asset('js/bootstrap/js/bootstrap-toggle.min.js') }}"></script> -->
<script>
   jQuery(document).ready(function() {
       $.getScript( "{{ asset('js/bootstrap/js/bootstrap-toggle.min.js') }}", function( data, textStatus, jqxhr ) {
            setTimeout(function () {
            $('input[name="status[]"]').bootstrapToggle();
        }, 100);
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
