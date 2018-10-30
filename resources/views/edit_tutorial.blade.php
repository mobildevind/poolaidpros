@extends('include-inner.main')

@section('content')


 <link rel="stylesheet" href="{{ asset('css/jquery.media.box.css') }}"/>
  <script src="{{ asset('js/jquery.media.box.js') }}"></script>
  <script>
    $(document).ready(function() {
      $('.media').mediaBox({
        closeImage: '{{ asset('images/close.png') }}',
        openSpeed: 800,
        closeSpeed: 800
      });
    });
  </script>
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
                           <form action="{{ route('update-ututorial') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden"  name="userid" id="userid" value="{{@$user_detail['user_detail']->id}}" >

                                 
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Catagory: </label>
                                        <div class="col-lg-8">
                                       
                                        <select class="form-control" name="catagory" id="Technicians">
                                        <option value="">-- Select New Catagory --</option>
                                        <?php foreach ($catagory as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>" <?php if($value->id == $user_detail['user_detail']->cat_id){  ?> selected="selected" <?php } ?>><?php echo $value->name; ?></option>
                                        <?php } ?>

                                        </select>

                                     
                                        
                                    </div>
                                </div>
                               
                                   <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Title: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="title"  class="form-control" placeholder="Name" value="{{@$user_detail['user_detail']->title}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                         
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label"> </label>
                                    <div class="col-lg-8">
                                        <?php 
                                        $disk = Storage::disk('public');
                                     
                                       
                                        $page = asset('storage/' . 'video_url/' .  $user_detail['user_detail']->video_url);
                                       
                                       // echo  '<video width="150" height="150" controls><source src="'.$page.'" type="video/mp4"></video>';
                                        ?>
                                        <div style="">
                                        <div class="media" data-src="<?php echo $page; ?>" data-width="640" data-height="360"
                                        style="cursor:pointer;"><video src ="<?php echo $page; ?>" style="width: 250px;"></video></div>
                                        </div>
                                        
                                        
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Video: </label>
                                    <div class="col-lg-8">
                                         <input type="file" name="file"   class="form-control" placeholder="File" value="" >
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Keyword: </label>
                                    <div class="col-lg-8">
                                    <input type="text" name="keyword" placeholder="keyword" value="{{@$user_detail['user_detail']->keyword}}" class="form-control">
                                      
                                        @if ($errors->has('address'))
                                        <p class="help-block">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                </div>
                               
                                
                                   <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Description: </label>
                                    <div class="col-lg-8">
                                    <textarea name="description"  style="height: 156px;" class="form-control" placeholder="Description">{{@$user_detail['user_detail']->description}}</textarea>
                                        
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                    
                                 
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Update</button>
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
            "file": {accept: "video/*"},
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





