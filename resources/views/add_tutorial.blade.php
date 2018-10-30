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

                  <!--       <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span> -->
                    </header>
                    <div class="panel-body">
                   <!--   <header class="panel-heading">
                             Company Information
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
                    </header> -->
                        <div id="wizard" style="    padding: 15px;">
                            <section>
                           <form action="{{ route('admin.insert-tutorial') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Catagory: </label>
                                        <div class="col-lg-8">
                                       
                                        <select class="form-control" name="catagory" id="Technicians">
                                        <option value="">-- Select New Catagory --</option>
                                        <?php foreach ($catagory as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                        <?php } ?>

                                        </select>

                                     
                                        
                                    </div>
                                </div>
                                 <!-- <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                <label class="col-lg-2 control-label">Company: </label>
                                    <div class="col-lg-8">
                                      <select class="form-control" name="company" id="Technicians">
                                        <option value="">-- Select New Company --</option>
                                        <?php foreach ($company_list as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                        <?php } ?>

                                        </select>
                                   <!--  <input type="text" name="company"  class="form-control" placeholder="Company" value="" > -->
                                   
                               <!--  </div>
                            </div> 
 -->
                                  
                                   <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Title: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="title"  class="form-control" placeholder="Title" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Video: </label>
                                    <div class="col-lg-8">
                                         <input type="file" name="file"  class="form-control" placeholder="File" value="" >
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Keyword: </label>
                                    <div class="col-lg-8">
                                    <input type="text" name="keyword" placeholder="Keyword" value="" class="form-control">
                                      
                                    </div>
                                </div>
                                 
                                   <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Description: </label>
                                    <div class="col-lg-8">
                                    <textarea   style="height: 156px;" class="form-control" placeholder="Description" name="description"></textarea>
                                        
                                    </div>
                                </div>
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Add</button>
                                            <a href="{{ route('tutorial') }}" class="btn btn-warning">Back</a>
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
            "catagory": "required",
            "title": "required",
            "keyword": "required",
            "file": {required:true,accept: "video/*"},
            "description": "required",
            
        },
        "messages": {
            "catagory": "The First Name field is required",
            "title": "The Last Name field is required",
            "keyword": "The Country code field is required",
            "file": "The Video field is required",
            "description": "The Phone field is required",
            
     
       
        },
        "submitHandler": function(form) {

            $('.submit_button').prop('disabled',true);
            form.submit();
        }

    });

</script>
@stop





