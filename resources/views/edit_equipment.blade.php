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
                           <form action="{{ route('update-equipment') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden"  name="userid" id="userid" value="{{@$equipment_detail['equipment_detail']->id}}" >

                              
                                  
                                   <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="name"  class="form-control" autocomplete="off" placeholder="Name" value="{{@$equipment_detail['equipment_detail']->name}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                           
                       <div class="form-group last">
                              <label class="col-lg-2 control-label">Photo: </label>   
                              <div class="col-md-8">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                 <?php  $video = asset('storage/' . 'users_images/' . $equipment_detail['equipment_detail']->photo);
                                    ?>
                                <img src="<?php echo $video; ?>" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                <span class="btn btn-white btn-file">
                                <span class="fileupload-new back-file"><i class="fa fa-paper-clip"></i>select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> change</span>
                                <input type="file" name="file" class="default" accept="image/png,image/jpeg,image/jpg"/>
                                </span>
                               <!--  <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>remove</a>
                                --> </div>
                                </div>
                                </div>
                                </div>

                                 

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Description: </label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" name="description"  placeholder="Description">{{@$equipment_detail['equipment_detail']->description}}</textarea>
                                       
                                    </div>
                                </div>
                                 
                                  
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Update</button>
                                            <a href="{{ route('equipment_list') }}" class="btn btn-warning">Back</a>
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
            "name": "required",
            "keyword": "required",
            "file": {accept: "image/*"},
            "description": "required",
            
        },
        "messages": {
            "catagory": "The First Name field is required",
            "name": "The Name field is required",
            "keyword": "The Country code field is required",
            "file": "The image field is required",
            "description": "The Phone field is required",
            
     
       
        },
        "submitHandler": function(form) {

            $('.submit_button').prop('disabled',true);
            form.submit();
        }

    });

</script>
@stop





