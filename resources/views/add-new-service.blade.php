@extends('include-inner.main')

@section('content')

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

                        <!-- <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span> -->
                    </header>
                    <div class="panel-body">
                    
                        <div id="wizard" style="    padding: 15px;">
                            <section>
                           <form action="{{ route('insert-service') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <input type="hidden" name="userid" class="form-control"  value="<?php echo $id; ?>" >


                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Choose Technician: </label>
                                    <div class="col-lg-8">
                                     <select class="form-control" name="Technicians" id="Technicians" ng-model="vm.employee.salary_recurrency">
                                        <option value="">-- Select New Technician --</option>
                                        <?php foreach ($technician as $key => $value) { ?>
                                           <option value="<?php echo $value->id; ?>"><?php echo $value->user_name; ?></option>
                                        <?php } ?>
                                       
                                    </select>
                                        
                                      
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>


                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Choose Customer: </label>
                                    <div class="col-lg-8">
                                     <select class="form-control" name="Technicians" id="Technicians" ng-model="vm.employee.salary_recurrency">
                                        <option value="">-- Select New Customer --</option>
                                        <?php foreach ($customers as $key => $value) { ?>
                                           <option value="<?php echo $value->id; ?>"><?php echo $value->user_name; ?></option>
                                        <?php } ?>
                                       
                                    </select>
                                        
                                      
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Category: </label>
                                    <div class="col-lg-8">
                                     <select class="form-control" name="catagory" id="catagory" ng-model="vm.employee.salary_recurrency">
                                        <option value="">-- Select New Catagory --</option>
                                        <?php foreach ($companycat as $key => $value) { ?>
                                           <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                        <?php } ?>
                                       
                                    </select>
                                        
                                      
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Name: </label>
                                    <div class="col-lg-8">
                                 
                                        
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Cost Price: </label>
                                    <div class="col-lg-8">
                                 
                                        
                                        <input type="text" name="cprice" onkeypress="return KeycheckOnlyNumeric(event);" class="form-control" placeholder="0.0" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Base Price: </label>
                                    <div class="col-lg-8">
                                 
                                        
                                        <input type="text" name="bprice" onkeypress="return KeycheckOnlyNumeric(event);" class="form-control" placeholder="0.0" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Duration (In Minutes) : </label>
                                    <div class="col-lg-8">
                                 
                                        
                                        <input type="number" name="duration" onkeypress="return KeycheckOnlyNumeric(event);" class="form-control" placeholder="0" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Description: </label>
                                    <div class="col-lg-8">
                                       <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>

                               
                              
                                 
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Add</button>

                                            <?php if($id == ''){ ?>
                                            <a href="{{route('get_user_list')}}" class="btn btn-warning">Back</a>
                                            <?php } else{ ?>
                                              <a href="{{ route('get_companyuser_list', ['id' => $id]) }}" class="btn btn-warning">Back</a>
                                            <?php } ?>

                                           
                                        </div> 
                                    </div>  
                            </form>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</section>
<!--main content end-->



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.js"></script>


<script>
   
    $("form#form-submit").validate({

        "errorElement": 'span',
        "errorClass": 'error',
        "rules": {
            "name": "required",
            "description": "required",
            
           
        },
        "messages": {
            "name": "The Catagory field is required",
            "description": "The description field is required",
            
       
        },
        "submitHandler": function(form) {

            $('.submit_button').prop('disabled',true);
            form.submit();
        }

    });

</script>
@stop





