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
                           <form action="{{ route('update-subscription') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden"  name="userid" id="userid" value="{{@$subscription_detail['subscription_detail']->id}}" >

                                 
                                 
                               
                                   <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Plan Title: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="title"  class="form-control" placeholder="Name" value="{{@$subscription_detail['subscription_detail']->plantitle}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                         
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Price: </label>
                                    <div class="col-lg-8">
                                    <input type="text" name="price" placeholder="Price" value="{{@$subscription_detail['subscription_detail']->price}}"  autocomplete="off" onkeypress="return KeycheckOnlyNumeric(event);"  class="form-control">
                                      
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Plan Day: </label>
                                    <div class="col-lg-8">
                                    <input type="text" name="day" placeholder="Ex:30" value="{{@$subscription_detail['subscription_detail']->days}}"  autocomplete="off" onkeypress="return KeycheckOnlyNumeric(event);"  class="form-control">
                                      
                                    </div>
                                </div>
                                
                                 
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Update</button>
                                            <a href="{{ route('subscription_plan_list') }}" class="btn btn-warning">Back</a>
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
            "price": "required",
            "title": "required",
            "day": "required",
            "file": {required:true,accept: "video/*"},
            "description": "required",
            
        },
        "messages": {
            "price": "The price field is required",
            "title": "The Title field is required",
            "day": "The day field is required",
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





