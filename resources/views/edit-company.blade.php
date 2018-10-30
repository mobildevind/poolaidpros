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

                     <!--    <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span> -->
                    </header>

                    <div class="panel-body">

                     <header>
                             <b>Company Information</b>
                    <!--     <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span> -->
                    </header>
                        <div id="wizard" style="    padding: 15px;">
                            <section>
                             <?php  $prefix = trans('constant.prefix'); 
                              if($prefix == '/admin'){                             ?>
                           <form action="{{ route('user.edit') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                           <?php } else{ ?>
                           <form action="{{ route('company_user_edit') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                           <?php } ?>
                            <?php  if($prefix == '/company'){ ?>
                           <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                           
                                             <a href="{{ route('company_delete', ['id' => $id]) }}" class="btn btn-warning" id="deletecompany" style="float: right;">Delete Company</a>

                                           
                                        </div> 
                                    </div>
                            <?php } ?>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                 <input type="hidden"  name="userid" id="userid" value="{{@$user_detail['user_detail']->userid}}" >

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{@$user_detail['user_detail']->name}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Phone: </label>
                                    <div class="col-lg-2">
                                        <input type="text" name="ccode" class="form-control" placeholder="Country code" value="{{@$user_detail['user_detail']->country_code}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" value="{{@$user_detail['user_detail']->phone}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                </div>

                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Email: </label>
                                    <div class="col-lg-8">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{@$user_detail['user_detail']->personemail}}" >
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Address: </label>
                                    <div class="col-lg-8">
                                    <input type="text" name="address" id="searchTextField" placeholder="Address" value="{{@$user_detail['user_detail']->address}}" class="form-control">
                                      
                                        @if ($errors->has('address'))
                                        <p class="help-block">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group last">
                              <label class="col-lg-2 control-label">Company Logo: </label>   
                              <div class="col-md-8">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" >
                                 <?php  
                                  if($user_detail['user_detail']->image){
                                 $video = asset('storage/' . 'users_images/' . $user_detail['user_detail']->image);
                                 }else{
                                   $video = '/images/logo.png';
                                 }
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
                                    <label class="col-lg-2 control-label">Company Logo: </label>
                                    <div class="col-lg-8">
                                     <?php 
                              
                                $video = asset('storage/' . 'users_images/' . $user_detail['user_detail']->image);
                           echo  '<img src="'.$video.'" alt="" height="100" width="150" style="    margin-bottom: 2px;"/>  ';

                              
                                ?>
                                    <input type="file" name="file" id="file" placeholder="File" class="form-control">
                                      
                                        @if ($errors->has('file'))
                                        <p class="help-block">{{ $errors->first('file') }}</p>
                                        @endif
                                    </div>
                                </div> -->

                                    <header>
                                    <b> Personal Information</b>
                                   <!--  <span class="tools pull-right">
                                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span> -->
                                    </header>
                                <span style="padding: 15px;"></span>
                                
<div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">First Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="fname" id="fname" class="form-control" placeholder="Name" value="{{@$user_detail['user_detail']->first_name}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Last Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Name" value="{{@$user_detail['user_detail']->last_name}}" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Phone: </label>
                                     <div class="col-lg-2">
                                        <input type="text" name="pccode" class="form-control" placeholder="Country code" value="{{@$user_detail['user_detail']->pcode}}" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="pphone" onkeypress="return KeycheckOnlyNumeric(event);" class="form-control" placeholder="Phone" value="{{@$user_detail['user_detail']->mobile}}" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                </div>

                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Email: </label>
                                    <div class="col-lg-8">
                                        <input type="email" name="pemail" class="form-control" placeholder="Email" value="{{@$user_detail['user_detail']->email}}" >
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <header >
                                     <b>Security Information</b>

                                    <!-- <span class="tools pull-right">
                                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span>
 -->                                    </header>
                                <span style="padding: 15px;"></span>
                               <div  class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">User Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="uname" class="form-control" placeholder="Name" value="{{@$user_detail['user_detail']->user_name}}" >
                                        @if ($errors->has('uname'))
                                        <p class="help-block">{{ $errors->first('uname') }}</p>
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Password: </label>
                                    <div class="col-lg-8">
                                        <input type="password" name="pass" class="form-control" placeholder="Password" value="" >
                                        @if ($errors->has('Password'))
                                        <p class="help-block">{{ $errors->first('Password') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Confirm Password: </label>
                                    <div class="col-lg-8">
                                        <input type="password" name="cpass" class="form-control" placeholder="Confirm Password" value="" >
                                        @if ($errors->has('Password'))
                                        <p class="help-block">{{ $errors->first('Password') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Update</button>
                                            <?php  if($prefix == '/admin'){ ?>
                                            <a href="{{route('get_company_list')}}" class="btn btn-warning">Back</a>
                                            <?php } else{ ?>
                                             <a href="{{ route('index', ['id' => $id]) }}" class="btn btn-warning">Back</a>
                                             <a href="{{ route('company_delete', ['id' => $id]) }}" class="btn btn-warning" id="deletecompany" style="float: right;">Delete Company</a>
                                           <?php } ?>
                                           
                                        </div> 
                                    </div>
                                     <header >
                                     <b>Member Detail</b>
                                  <!--   <span class="tools pull-right">
                                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span> -->
                                    </header>
                                <span style="    padding: 15px;"></span>
                                 <div class="form-group">
                                     <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-8">
                                <div class="table-responsive">
                                  <table class="table">
                                   <thead>
                                      <tr>
                                        <th>Photo</th>
                                        <th>Members</th>
                                        <th>Position</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        
                                      </tr>
                                    </thead>
                                     <tbody>
                         <?php if(!empty($member_detail)){ ?>
                             <?php foreach ($member_detail as $key => $value) {  ?>
                            
                                     <?php
                                    $disk = Storage::disk('public');
                                    if($value->image == '' || !$disk->exists('users_images/'.$value->image)) {
                                    $photo = asset('storage/' . 'users_images/default.jpg');;
                                    } else {
                                    $photo = asset('storage/' . 'users_images/' . $value->image);
                                    }
                                    $link = asset('/company/view_employe/'.$value->userid.'&'.$id);

                                    ?>
                                     <tr>
                                    <td><img src="{{@$photo}}" alt="" height="50" width="50" /></td>
                                    <td><a href="{{@$link}}" style="color:#4dacc4">{{@$value->first_name}}</a> </td>

                                    <td>{{@$value->position}}</td>
                                    <td>{{@$value->country_code}}{{@$value->mobile}}</td>
                                    <td>{{@$value->email}}</td>
                                    </tr>  
                            
                            <?php } } else{ ?>
                            <tr>
                                 <td colspan="7" style="text-align: center;">No Member Available </td>
                                
                             </tr>
                             <?php } ?>
                            </tbody>
                          </table>
                        </div>
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
    var pmobile_messages = {
    required: "The Mobile field is required",
    number: "Only Number allow",
    minlength: "Minimum 10 digit allow",
    maxlength: "Maximum 10 digit allow",
   
    };
    var email_messages = {
    required: "The Email field is required",
    email: "Invalid Email",
    remote: "Already Email exist",
    };
    var pemail_messages = {
    required: "The Email field is required",
    email: "Invalid Email",
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
            type:'2',id:$('#userid').val()
            }}
            },
           "email": {"required": true, "email": true,remote: { 
            url: "/admin/check_email",
            type: "get",
            data: {id:$('#userid').val(),type:'2'
            }}},
            "address": "required",
            "name": {"required":true , lettersonly: true},
            "pccode": "required",
            "pphone": {"required": true, "number": true,"minlength": 10,"maxlength":10},
            "pemail": "required",
            "uname": "required",
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
             "pphone": pmobile_messages,
             "pemail": pemail_messages,
             "uname": "The User Name field is required",
             "cpass": cpassword_messages,
     
       
        },
        "submitHandler": function(form) {

            $('.submit_button').prop('disabled',true);
            form.submit();
        }

    });

</script>

@stop





