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
                       <!--  <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span> -->
                    </header>
                        <div id="wizard" style="    padding: 15px;">
                            <section>
                           <form action="{{ route('insert_company') }}" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-submit"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Company Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" autocomplete="off" name="name" class="form-control" placeholder="Company Name" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Phone: </label>
                                    <div class="col-lg-2">
                                        <input type="text" name="ccode" class="form-control" placeholder="Country code" value="" autocomplete="off" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" value="" autocomplete="off" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                </div>

                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Email: </label>
                                    <div class="col-lg-8">
                                        <input type="email" name="email" autocomplete="off" class="form-control" placeholder="Email" value="" >
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Address: </label>
                                    <div class="col-lg-8">
                                    <input type="text" name="address"  id="searchTextField" placeholder="Address" class="form-control">
                                      
                                        @if ($errors->has('address'))
                                        <p class="help-block">{{ $errors->first('address') }}</p>
                                        @endif
                                    </div>
                                </div>

                            <div class="form-group last">
                            <label class="col-lg-2 control-label">Company Logo: </label>   
                            <div class="col-md-8">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                            <img src="/images/logo.png" alt="" />
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

                                <!--  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Company Logo: </label>
                                    <div class="col-lg-8">
                                    <input type="file" name="file" autocomplete="off" id="file" placeholder="File" class="form-control">
                                      
                                        @if ($errors->has('file'))
                                        <p class="help-block">{{ $errors->first('file') }}</p>
                                        @endif
                                    </div>
                                </div> -->

                                    <header >
                                     <b>Personal Information</b>
                                  <!--   <span class="tools pull-right">
                                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span> -->
                                    </header>
                                <span style="    padding: 15px;"></span>
                                
<div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">First Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" autocomplete="off" name="fname" id="fname" class="form-control" placeholder="Fist Name" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Last Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" autocomplete="off" name="lname" id="lname" class="form-control" placeholder="Last Name" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Phone: </label>
                                     <div class="col-lg-2">
                                        <input type="text" autocomplete="off" name="pccode" class="form-control" placeholder="Country code" value="" onkeypress="return KeycheckOnlyNumeric(event);" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" autocomplete="off" name="pphone" onkeypress="return KeycheckOnlyNumeric(event);" class="form-control" placeholder="Phone" value="" >
                                        @if ($errors->has('Phone'))
                                        <p class="help-block">{{ $errors->first('Phone') }}</p>
                                        @endif
                                    </div>
                                </div>

                                  <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Email: </label>
                                    <div class="col-lg-8">
                                        <input type="email" autocomplete="off" name="pemail" class="form-control" placeholder="Email" value="" >
                                        @if ($errors->has('Email'))
                                        <p class="help-block">{{ $errors->first('Email') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <header >
                                     <b>Security Information</b>
                                  <!--   <span class="tools pull-right">
                                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    </span> -->
                                    </header>
                                <span style="    padding: 15px;"></span>
                               <div  class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">User Name: </label>
                                    <div class="col-lg-8">
                                        <input type="text" autocomplete="off" name="uname" class="form-control" placeholder="Name" value="" >
                                        @if ($errors->has('uname'))
                                        <p class="help-block">{{ $errors->first('uname') }}</p>
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Password: </label>
                                    <div class="col-lg-8">
                                        <input type="password" autocomplete="off" name="pass" class="form-control" placeholder="Password" value="" >
                                        @if ($errors->has('Password'))
                                        <p class="help-block">{{ $errors->first('Password') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Confirm Password: </label>
                                    <div class="col-lg-8">
                                        <input type="password" autocomplete="off"    name="cpass" class="form-control" placeholder="Confirm Password" value="" >
                                        @if ($errors->has('Password'))
                                        <p class="help-block">{{ $errors->first('Password') }}</p>
                                        @endif
                                    </div>
                                </div>

                                 
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>  
                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success submit_button">Add</button>
                                            <a href="{{route('get_company_list')}}" class="btn btn-warning">Back</a>
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
    required: "The Confirm Password field is required",
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
     var pemail_messages = {
    required: "The Email field is required",
    email: "Invalid Email",
    
    };
     var fname_message = {
    required: "The First Name field is required",
    lettersonly: "Please enter only alphabetical letters",
    
    };
     var lname_message = {
    required: "The Last Name field is required",
    lettersonly: "Please enter only alphabetical letters",
    
    };
    var pfname_message = {
    required: "The Person Name field is required",
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
            type:'2',id:''
            }}
            },
            "email": {"required": true, "email": true,remote: { 
            url: "/admin/check_email",
            type: "get",
            data: {id:'',type:'2'
            }}},
            "address": "required",
            "name": {"required":true , lettersonly: true},
            "pccode": "required",
            "pphone": "required",
            "pemail": "required",
            "uname": "required",
            "pass": "required",
            "cpass": {"required": true, "equalTo": "input:password[name='pass']"},
           
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
            "pemail": pemail_messages,
            "uname": "The User Name field is required",
            "pass": "The Password field is required",
            "cpass": cpassword_messages,
       
        },
        "submitHandler": function(form) {

            $('.submit_button').prop('disabled',true);
            form.submit();
        }

    });

</script>
@stop





