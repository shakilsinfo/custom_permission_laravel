<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>EMS Login Panel</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
{!!Html::style('public/custom/css/bootstrap.min.css')!!}
<!-- Font Awesome -->
{!!Html::style('public/custom/css_icon/font-awesome/css/font-awesome.min.css')!!}
<!-- Ionicons -->
{!!Html::style('public/custom/css_icon/Ionicons/css/ionicons.min.css')!!}
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
<!-- Google Font -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
{!!Html::style('public/custom/css/login.css')!!}
<!-- jQuery 3 -->
{!!Html::script('public/custom/js/plugins/jquery/dist/jquery.min.js')!!}
<!-- Bootstrap 3.3.7 -->
{!!Html::script('public/custom/js/plugins/bootstrap/dist/js/bootstrap.min.js')!!}
</head>
<body>
<div class="container">

  @if(Session::has('flash_mail'))
  <div class="alert alert-<? echo session('status_color'); ?>" style="font-size: 16px;"><em> {!! session('flash_mail') !!}</em></div>
  @endif
</div>
<?php
  $user_role = DB::table('user_role')->get();
?>
<div class="form">
  <div class="image_holder"><img src="{{asset("storage/app/public/uploads/logo/logo.png")}}"/></div>
 @if(Session::get('error'))
  <div class="custom-alerts alert alert-danger fade in">
    <ul style="list-style-type:none">
      <li><i class="fa fa-times-circle-o" aria-hidden="true"></i> {{ Session::get('error') }}</li>
      <?php Session::put('error', NULL); ?>
    </ul>
  </div>
  @elseif ($errors->has('email'))
  <div class="custom-alerts alert alert-danger fade in"> <strong>{{ $errors->first('email') }}</strong> </div>
  @endif
  <form name="form" action="{{ url('/login')}}"  class="login-form" method="POST" id="form">
    {{ csrf_field() }}
    <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Email" required>
    <input id="password" type="password" name="password" placeholder="Password" required>
    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
    <select class="form-control" id="roleId" name="role_id" required>
      <option value="">Select User Role</option>
      @foreach($user_role as $role)
        <option value="{{$role->id}}">{{$role->role_name}}</option>
      @endforeach
    </select>
    <div style="margin-top:15px;"><button type="submit" class="btn btn-danger"><i class="fa fa-user"></i> Log in</button></div>
    <!--<p class="message"><a class="underlineHover" href="#forgotPassword" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a></p>-->
  </form>

</div>

  <script type="text/javascript">
    $( document ).ready(function() {
        setTimeout(function(){
        $(".alert").slideUp();
      }, 7000);
    });
  </script>
</body>
</html>
