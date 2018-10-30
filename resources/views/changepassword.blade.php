@extends('include-inner.main')

@section('content')

@php ($edit = (Request::segment(3) == 'edit'))

<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
        @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}{{Session::forget('message')}}</p>
    @endif
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       <?php echo  $title; ?>

                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div id="wizard">
                            <section>
                           <form action="{{route('admin.updatepassword')}}" method="post" class="form-horizontal" enctype="multipart/form-data" id="changepass_frm"> 
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                               <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">User Name: </label>
                                    <div class="col-lg-8">

                                        <input type="text" name="username" id="username" class="form-control" placeholder="User Name" value="<?php echo $checkandget->user_name; ?>" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Old password: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="old_password" id="old_password" class="form-control" placeholder="Old Password" value="" >
                                        @if ($errors->has('title'))
                                        <p class="help-block">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">New Password: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="new_password" id="new_password" class="form-control" placeholder="New Password" value="" >
                                        @if ($errors->has('description'))
                                        <p class="help-block">{{ $errors->first('description') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ ($errors->has('type')) ? 'has-error' : '' }}">
                                    <label class="col-lg-2 control-label">Confim Password: </label>
                                    <div class="col-lg-8">
                                        <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="" >
                                        @if ($errors->has('location'))
                                        <p class="help-block">{{ $errors->first('location') }}</p>
                                        @endif
                                    </div>
                                </div>
                                 <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>

                                        <div class="col-lg-8">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a href="{{route('admin.home')}}" class="btn btn-warning">Back</a>
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

<script type="text/javascript" src="{{ asset('js/jquery.validate.min.js') }}"ss></script>

<script>
    jQuery(document).ready(function() {
        $("#changepass_frm").validate({
            rules: {
                username: "required",
                old_password: "required",
                new_password: "required",
                confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                username: "{{ 'User Name is required' }}",
                old_password: "{{ 'Please enter your old password' }}",
                new_password: "{{ 'Please enter your new password' }}",
                confirm_password: {
                    required: "{{ 'Please enter your confirm password' }}",
                    equalTo: "{{  'The confirm password and new password must match' }}"
                }
            }
        });
    });
</script>
@stop

