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

                      <!--   <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span> -->
                    </header>
                    <div class="panel-body">
                    
                        <div id="wizard" style="    padding: 15px;">
                            <section>
                           <form action="{{ route('update_employe') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="userid" id="userid" value="{{@$id}}">
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">First Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="readonly" name="name" class="form-control" placeholder="Name" value="{{@$user_detail['user_detail']->first_name}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Last Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="readonly"  name="lname" class="form-control" placeholder="Last Name" value="{{@$user_detail['user_detail']->last_name}}" >
                                        @if ($errors->has('lname'))
                                        <p class="help-block">{{ $errors->first('lname') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Position: </label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="readonly"  name="position" class="form-control" placeholder="Position" value="{{@$user_detail['user_detail']->position}}" >
                                        @if ($errors->has('lname'))
                                        <p class="help-block">{{ $errors->first('lname') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Phone: </label>
                                    <div class="col-lg-2">
                                        <input type="text" readonly="readonly"  name="ccode" class="form-control" placeholder="Country code" value="{{@$user_detail['user_detail']->country_code}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" readonly="readonly"  name="phone" class="form-control" placeholder="Phone" value="{{@$user_detail['user_detail']->mobile}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                </div>
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Secondary Phone: </label>
                                    <div class="col-lg-2">
                                        <input type="text" readonly="readonly"  name="sccode" class="form-control" placeholder="Country code" value="{{@$user_detail['user_detail']->scountry_code}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" readonly="readonly"  name="sphone" class="form-control" placeholder="Secondary Phone" value="{{@$user_detail['user_detail']->sphone}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                </div>

                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Email: </label>
                                    <div class="col-lg-8">
                                        <input type="email" readonly="readonly"  name="email" class="form-control" placeholder="Email" value="{{@$user_detail['user_detail']->email}}" >
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Address: </label>
                                    <div class="col-lg-8">
                                    <input type="text" readonly="readonly"  name="address" id="searchTextField" value="{{@$user_detail['user_detail']->address}}" placeholder="Address" class="form-control">
                                      
                                        @if ($errors->has('address'))
                                        <p class="help-block">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group last">
                              <label class="col-lg-2 control-label">Photo: </label>   
                              <div class="col-md-8">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" >
                                 <?php     $video = asset('storage/' . 'users_images/' . $user_detail['user_detail']->image);
                                  ?>
                                <img src="<?php echo $video; ?>" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                               <!--  <span class="btn btn-white btn-file">
                                <span class="fileupload-new back-file"><i class="fa fa-paper-clip"></i>select image</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> change</span>
                                <input type="file" name="file" class="default" accept="image/png,image/jpeg,image/jpg"/>
                                </span> -->
                               <!--  <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i>remove</a>
                                --> </div>
                                </div>
                                </div>
                                </div>
                               <!--  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                <label class="col-lg-2 control-label">Image: </label>
                                <div class="col-lg-8">
                                 <?php 

                                    $video = asset('storage/' . 'users_images/' . $user_detail['user_detail']->image);
                                    echo  '<img src="'.$video.'" alt="" height="100" width="150" style="    margin-bottom: 2px;"/>  ';


                                    ?>
                                <input type="file" name="file" class="form-control" placeholder="File" value="" >
                                @if ($errors->has('file'))
                                <p class="help-block">{{ $errors->first('file') }}</p>
                                @endif
                                </div>
                                </div> -->
                              
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">User Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" readonly="readonly"  name="username" class="form-control" placeholder="User Name" value="{{@$user_detail['user_detail']->user_name}}" >
                                        @if ($errors->has('username'))
                                        <p class="help-block">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">About: </label>
                                    <div class="col-lg-8">
                                       <textarea name="about" readonly="readonly"  class="form-control">{{@$user_detail['user_detail']->about}}</textarea>
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>
                           <!--       <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Password: </label>
                                    <div class="col-lg-8">
                                        <input type="password" name="pass" class="form-control" placeholder="Password" value="" >
                                        @if ($errors->has('password'))
                                        <p class="help-block">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                </div>
                                   <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Confirm Password: </label>
                                    <div class="col-lg-8">
                                        <input type="password" autocomplete="off" name="cpass" class="form-control" placeholder="Confirm Password" value="" >
                                        @if ($errors->has('Password'))
                                        <p class="help-block">{{ $errors->first('Password') }}</p>
                                        @endif
                                    </div>
                                </div>
                                -->
                              
                                 
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                           <!--  <button type="submit" class="btn btn-success submit_button">Update</button>
                                            --> <a href="{{ route('get_employe_list') }}" class="btn btn-warning">Back</a>
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
   var cpassword_messages = {
    equalTo: "Your password and confirmation password do not match",
    };
     var mobile_messages = {
    required: "The Mobile field is required",
    number: "Only Number allow",
    minlength: "Minimum 9 digit allow",
    maxlength: "Maximum 10 digit allow",
    remote: "Mobile Number Already exist",
    };
    var email_messages = {
    required: "The Email field is required",
    email: "Invalid Email",
    remote: "Already Email exist",
    };
    $("form#form-submit").validate({

        "errorElement": 'span',
        "errorClass": 'error',
        "rules": {
            "fname": "required",
            "lname": "required",
            "ccode": "required",
            "phone": {"required": true, "number": true,"minlength": 9,"maxlength":10, 
            remote: { 
            url: "/admin/check_mobile",
            type: "get",
            data: {
            type:'4',id:$('#userid').val()
            }}
            },
            "email": {"required": true, "email": true,remote: { 
            url: "/admin/check_email",
            type: "get",
            data: {id:$('#userid').val(),type:'4'
            }}},
            "address": "required",
            "name": "required",
            "pccode": "required",
            "pphone": "required",
            "pemail": "required",
            "about": "required",
            "cpass": {"equalTo": "input:password[name='pass']"},
         
           
        },
        "messages": {
            "fname": "The First Name field is required",
            "lname": "The Last Name field is required",
            "ccode": "The Country code field is required",
            "phone": mobile_messages,
              "email": email_messages,
             "address": "The Address field is required",
             "name": "The Person Name field is required",
             "pccode": "The Country code field is required",
             "pphone": "The Person Phone field is required",
             "pemail": "The Person Email field is required",
             "about": "The About field is required",
              "cpass": cpassword_messages,
           
       
        },
        "submitHandler": function(form) {

            $('.submit_button').prop('disabled',true);
            form.submit();
        }

    });

</script>
@stop





