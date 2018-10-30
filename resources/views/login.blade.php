@extends('include-outer.main')

@section('content')

<form class="form-signin" action="{{route('check.login')}}">
<h2 class="form-signin-heading"><img src=" <?php echo asset('images/logo.png/'); ?>" style="width: 50px;" alt="">   sign in now</h2>
 @if(Session::has('login_message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="color:orangered">{{ Session::get('login_message') }} {{Session::forget('login_message')}}</p>

            @endif
<div class="login-wrap">            
    <div class="user-login-info{{ $errors->has('username') ? ' has-error' : '' }}">
        <input type="text" class="form-control" placeholder="User Name" value="" autofocus name="username" value="{{ old('username') }}" >
        @if ($errors->has('username'))
        <span class="help-block">
            <strong>{{ $errors->first('username') }}</strong>
        </span>
        @endif
        <input type="password" class="form-control" placeholder="Password" value="" name="password">
        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
<!--    <span class="pull-right">
        <a data-toggle="modal" href="/admin/forgot_password"> Forgot Password?</a>
    </span>
    <br>-->
    <label class="checkbox">
        <input type="checkbox" name="remember_me" value="remember-me"> Remember me
        <span class="pull-right">
            <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

        </span>
    </label>
    <button class="btn btn-lg btn-login btn-block" type="submit" name="login">Sign In</button>
<!--    <div class="registration">
        Don't have an account yet?
        <a class="" href="/admin/registration">
            Create an account
        </a>
    </div>-->
</div>
</form>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form action="javascript:void(0);" class="form-forget" id='forgot_password_frm'>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Password?</h4>
            </div>
            <div class="modal-body">
                <p>Enter your e-mail address below to reset your password.</p>
                <p id="forgotemailmsg" style="color:red;"></p>
                <input type="text" name="forgotemail" id="forgotemail"  placeholder="Email Address" autocomplete="off" class="form-control placeholder-no-fix">
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <button class="btn btn-success" onclick="forgetpassword();" type="submit">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

@stop

<script type="text/javascript">
    function forgetpassword() {
      var email = $('#forgotemail').val();
      var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

      if(email == null || email == '' || !pattern.test(email)){
        $('#forgotemail').css({"border-color": "red", 
             "border-width":"1px", 
             "border-style":"solid"});
        return false;
      }else{
          $('#forgotemail').css({"border-color": "#c2c2c2", 
             "border-width":"1px", 
             "border-style":"solid"});
      }

       $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: "POST",
      url: "{{ route('forgetpassworda.get') }}",
       data: {'email': email},
      success: function( msg ) {
      
      if(msg == 0){
        alert('Please enter correct email ID');
      }else{
        alert('New password is mail on your email id');
       location.reload();

      }
      }
        });
    }
   

</script>