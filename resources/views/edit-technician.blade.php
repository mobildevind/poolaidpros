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

                       <!--  <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span> -->
                    </header>
                    <div class="panel-body">
                    
                        <div id="wizard" style="    padding: 15px;">
                            <section>
                           <form action="{{ route('update_tecnician') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden" name="userid" id="userid" value="{{@$id}}">
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">First Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{@$user_detail['user_detail']->first_name}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Last Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="lname" class="form-control" placeholder="Last Name" value="{{@$user_detail['user_detail']->last_name}}" >
                                        @if ($errors->has('lname'))
                                        <p class="help-block">{{ $errors->first('lname') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Position: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="position" class="form-control" placeholder="Position" value="{{@$user_detail['user_detail']->position}}" >
                                        @if ($errors->has('position'))
                                        <p class="help-block">{{ $errors->first('position') }}</p>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                <label class="col-lg-2 control-label">Exprience: </label>
                                <div class="col-lg-8">
                                <input type="text" name="exp" class="form-control" placeholder="Exprience" value="{{@$user_detail['user_detail']->exprience}}" >
                                @if ($errors->has('exprience'))
                                <p class="help-block">{{ $errors->first('exprience') }}</p>
                                @endif
                                </div>
                                </div>

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Contact Number: </label>
                                    <div class="col-lg-2">
                                        <input type="text" name="ccode" class="form-control" placeholder="Country code" value="{{@$user_detail['user_detail']->country_code}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{@$user_detail['user_detail']->mobile}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                <label class="col-lg-2 control-label">Date of birth: </label>
                                 <div class="col-lg-8 date-input-custom">
                                        <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="{{@date('Y-m-d')}}"  class="input-append date date">
                                            <input type="text" readonly="" placeholder="Date of birth" id="end" name="dob" style="background-color: #fff;" value="{{@date('m/d/Y', strtotime($user_detail['user_detail']->dob))}}" size="16" class="form-control">
                                            <span class="input-group-btn add-on">
                                                <button class="btn btn-primary" type="button"><i class="fa fa-calendar"></i></button>
                                            </span>
                                        </div>
                                  
                                    </div>
                                </div>

                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Email: </label>
                                    <div class="col-lg-8">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{@$user_detail['user_detail']->email}}" >
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Address: </label>
                                    <div class="col-lg-8">
                                    <input type="text" name="address" id="searchTextField" value="{{@$user_detail['user_detail']->address}}" placeholder="Address" class="form-control">
                                      
                                        @if ($errors->has('address'))
                                        <p class="help-block">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group last">
                              <label class="col-lg-2 control-label">Photo: </label>   
                              <div class="col-md-8">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                 <?php    $video = asset('storage/' . 'users_images/' . $user_detail['user_detail']->image);
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
                                <!-- <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
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
                                    <label class="col-lg-2 control-label">About Me: </label>
                                    <div class="col-lg-8">
                                       <textarea name="about" class="form-control">{{@$user_detail['user_detail']->about}}</textarea>
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                <label class="col-lg-2 control-label">Interests: </label>
                                <div class="col-lg-8">
                                <input type="text" name="interests" class="form-control" placeholder="Interests" value="{{@$user_detail['user_detail']->interests}}" >
                                @if ($errors->has('interests'))
                                <p class="help-block">{{ $errors->first('interests') }}</p>
                                @endif
                                </div>
                                </div>
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                <label class="col-lg-2 control-label">Fevorite shows: </label>
                                <div class="col-lg-8">
                                <input type="text" name="fevoriteshows" class="form-control" placeholder="Fevorite shows" value="{{@$user_detail['user_detail']->fevouriteshows}}" >
                                @if ($errors->has('fevoriteshows'))
                                <p class="help-block">{{ $errors->first('fevoriteshows') }}</p>
                                @endif
                                </div>
                                </div>
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Fevorite Book: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="fevoritebook" class="form-control" placeholder="Fevorite shows" value="{{@$user_detail['user_detail']->fevoritebook}}" >
                                        @if ($errors->has('fevoritebook'))
                                        <p class="help-block">{{ $errors->first('fevoritebook') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Facebook Link: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="facebook" class="form-control" placeholder="Facebook" value="{{@$user_detail['user_detail']->facebooklink}}" >
                                        @if ($errors->has('facebook'))
                                        <p class="help-block">{{ $errors->first('facebook') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Instagram Link: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="instagram" class="form-control" placeholder="Instagram Link" value="{{@$user_detail['user_detail']->instagramlink}}" >
                                        @if ($errors->has('instagram'))
                                        <p class="help-block">{{ $errors->first('instagram') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Linkedin Link: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="linkedin" class="form-control" placeholder="linkedin" value="{{@$user_detail['user_detail']->linkedin}}" >
                                        @if ($errors->has('linkedin'))
                                        <p class="help-block">{{ $errors->first('linkedin') }}</p>
                                        @endif
                                    </div>
                                </div>
                                   <header class="panel-heading" style="margin-bottom: 14px;background: none;">
                     </header>
                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">User Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="username" class="form-control" placeholder="User Name" value="{{@$user_detail['user_detail']->user_name}}" >
                                        @if ($errors->has('username'))
                                        <p class="help-block">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                </div>
                                  
                                 
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Password: </label>
                                    <div class="col-lg-8">
                                        <input type="password" autocomplete="off" name="pass" class="form-control" placeholder="Password" value="" >
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


                               
                              
                                 
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Update</button>
                                            <a href="{{route('get_technicians_list')}}" class="btn btn-warning">Back</a>
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
        var fname_message = {
    required: "The First Name field is required",
    lettersonly: "Please enter only alphabetical letters",
    
    };
    var pfname_message = {
    required: "The Person Name field is required",
    lettersonly: "Please enter only alphabetical letters",
    
    };
    
     var lname_message = {
    required: "The Last Name field is required",
    lettersonly: "Please enter only alphabetical letters",
    };
    $("form#form-submit").validate({

        "errorElement": 'span',
        "errorClass": 'error',
        "rules": {
           "fname": {"required":true , lettersonly: true},
            "lname": {"required":true , lettersonly: true},
            "ccode": "required",
           "phone": {"required": true, "number": true,"minlength": 9,"maxlength":10, 
            remote: { 
            url: "/admin/check_mobile",
            type: "get",
            data: {
            type:'3',id:$('#userid').val()
            }}
            },
             "email": {"required": true, "email": true,remote: { 
            url: "/admin/check_email",
            type: "get",
            data: {id:$('#userid').val(),type:'3'
            }}},
            "address": "required",
            "name": {"required":true , lettersonly: true},
            "pccode": "required",
            "pphone": "required",
            "pemail": "required",
            "about": "required",
            "salary_recurrency": "required",
            "salary": "required",
            "cpass": {"equalTo": "input:password[name='pass']"},
           
        },
        "messages": {
           "fname": fname_message,
            "lname": lname_message,
            "ccode": "The Country code field is required",
            "phone": mobile_messages,
            "email": email_messages,
             "address": "The Address field is required",
            "name": pfname_message,
             "pccode": "The Country code field is required",
             "pphone": "The Person Phone field is required",
             "pemail": "The Person Email field is required",
             "about": "The About field is required",
             "salary_recurrency": "The Salary Recurrency field is required",
             "salary": "The salary field is required",
             "cpass": cpassword_messages,
       
        },
        "submitHandler": function(form) {

            $('.submit_button').prop('disabled',true);
            form.submit();
        }

    });

</script>
@stop





