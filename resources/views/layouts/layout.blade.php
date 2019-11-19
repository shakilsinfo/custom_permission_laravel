<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>@yield('title')</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Bootstrap 3.3.7 -->
{!!Html::style('public/custom/css/bootstrap.min.css')!!}
<!-- Font Awesome -->
{!!Html::style('public/custom/css_icon/font-awesome/css/font-awesome.min.css')!!}
<!-- Theme style -->
{!!Html::style('public/custom/css/AdminLTE.css')!!}
<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
{!!Html::style('public/custom/css/skins/_all-skins.css')!!}
{!!Html::style('public/custom/css/style.css')!!}
{!!Html::style('public/custom/css/summernote.min.css')!!}
{!!Html::style('public/custom/css/jquery-ui.min.css')!!}
{!!Html::style('public/custom/css/bootstrap-toggle.min.css')!!}
{!!Html::style('public/custom/css/bootstrap-tagsinput.css')!!}

{!!Html::style('public/custom/css/fonts.css')!!}
<!-- jQuery 3 -->
{!!Html::script('public/custom/js/plugins/jquery/dist/jquery.min.js')!!}
{!!Html::script('public/js/jquery.validate.js')!!}

<!-- Bootstrap 3.3.7 -->
{!!Html::script('public/custom/js/plugins/bootstrap/dist/js/bootstrap.min.js')!!}
{!!Html::script('public/custom/js/plugins/bootstrap/dist/js/bootstrap-confirmation.min.js')!!}
<!-- SlimScroll -->
{!!Html::script('public/custom/js/plugins/jquery-slimscroll/jquery.slimscroll.js')!!}
<!-- FastClick -->
{!!Html::script('public/custom/js/plugins/fastclick/lib/fastclick.js')!!}
<!-- AdminLTE App -->
{!!Html::script('public/custom/js/adminlte.js')!!}
<!--datepicker-->
{!!Html::script('public/custom/js/plugins/datepicker/bootstrap-datepicker.js')!!}
{!!Html::style('public/custom/js/plugins/datepicker/datepicker3.css')!!}
<!-- AdminLTE for demo purposes -->
{!!Html::script('public/custom/js/demo.js')!!}
{!!Html::script('public/custom/js/jquery-ui.js')!!}
{!!Html::script('public/custom/js/summernote.min.js')!!}
{!!Html::script('public/custom/js/bootstrap-toggle.min.js')!!}
{!!Html::script('public/custom/js/bootstrap-tagsinput.js')!!}
{!!Html::script('public/custom/js/sweetalert.min.js')!!}
{!!Html::script('public/custom/js/notify.js')!!}
{!!Html::script('public/custom/js/jscolor.js')!!}
{!!Html::script('public/custom/js/plugins/chart/chart.js')!!}
<!-- select dropdown -->
{!!Html::style('public/custom/js/plugins/select/select2.min.css')!!}
{!!Html::script('public/custom/js/plugins/select/select2.min.js')!!}
{!!Html::script('public/js/money-format.js')!!}
{!!Html::script('public/js/ckeditor.js')!!}
{!!Html::script('public/js/jquery-barcode-scanner.js')!!}
{!!Html::script('public/js/radio-input.js')!!}
</head>
<body class="sidebar-mini fixed sidebar-mini-expand-feature skin-green">
<?php
  $uri = Request::path();

  use App\Library\ACL;

  $routesCheck = [];
  
  foreach (ACL::getControllerRoute() as $key => $value) {
     $routesCheck[] = $value;
  }
  

?>
<!-- Site wrapper -->
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{URL::To('dashboard')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><i class="fa fa-dashboard fa-2x" aria-hidden="true"></i></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">EMS</span> </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               @if(Auth::user()->image !=null)
              {!!Html::image( asset('/storage/app/public/uploads/users/'.Auth::user()->image), 'User Image', array('class' => 'user-image'))!!}
              @else
              {!!Html::image( asset('/storage/app/public/uploads/profile.png'), 'User Image', array('class' => 'img-circle','height'=>'25px','width'=>'25px'))!!}
              @endif
              <span class="hidden-xs">{{Auth::user()->name}}</span> </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  @if(Auth::user()->image !=null)
                  {!!Html::image( asset('/storage/app/public/uploads/users/'.Auth::user()->image), 'User Image', array('class' => 'img-circle','height'=>'25px','width'=>'25px'))!!}
                  @else
                  {!!Html::image( asset('/storage/app/public/uploads/profile.png'), 'User Image', array('class' => 'img-circle','height'=>'25px','width'=>'25px'))!!}
                  @endif
                  <p>Hello<br/>
                    <small>Admin</small><small></small></p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left"> <a href="javascript:;" data-toggle="modal" data-target="#profile_modal" class="btn btn-primary btn-flat">Profile</a> </div>
                  <div class="pull-right"> <a id="__logout_system" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-danger btn-flat">Sign out</a> </div>
                </li>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                </form> 
              </ul>
            </li>
        
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{($uri=='dashboard')?'active':''}}"><a href="{{URL::To('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
        <li class="{{($uri=='category')?'active':''}}"><a href="{{URL::To('category')}}"><i class="fa fa-list"></i> <span>Category</span> </a> </li>
        <li class="{{($uri=='product')?'active':''}}"><a href="{{URL::To('product')}}"><i class="fa fa-product-hunt"></i> <span>Product</span> </a> </li>
        <li class="{{($uri=='blog')?'active':''}}"><a href="{{URL::To('blog')}}"><i class="fa fa-cog"></i> <span>Blog</span> </a> </li>
        <li class="{{($uri=='user-role')?'active':''}}"><a href="{{URL::To('user-role')}}"><i class="fa fa-user"></i> <span>User Role</span> </a> </li>
        <li class="{{($uri=='all-controller-list')?'active':''}}"><a href="{{URL::To('all-controller-list')}}"><i class="fa fa-user"></i> <span>All Controller Name</span> </a> </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> @yield('content') </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs"> <b>Version</b> 1.0.0 </div>
    <strong>Copyright &copy; 2017 <a target="_blank" href="http://webitsoft.net">webitsoft.com</a>.</strong> All rights
    reserved. </footer>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-birthday-cake bg-red"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
              <p>Will be 23 on April 24th</p>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-user bg-yellow"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
              <p>New phone +1(800)555-1234</p>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
              <p>nora@example.com</p>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)"> <i class="menu-icon fa fa-file-code-o bg-green"></i>
            <div class="menu-info">
              <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
              <p>Execution time 5 seconds</p>
            </div>
            </a> </li>
        </ul>
        <!-- /.control-sidebar-menu -->
        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Custom Template Design <span class="label label-danger pull-right">70%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Update Resume <span class="label label-success pull-right">95%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-success" style="width: 95%"></div>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Laravel Integration <span class="label label-warning pull-right">50%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
            </div>
            </a> </li>
          <li> <a href="javascript:void(0)">
            <h4 class="control-sidebar-subheading"> Back End Framework <span class="label label-primary pull-right">68%</span> </h4>
            <div class="progress progress-xxs">
              <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
            </div>
            </a> </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading"> Report panel usage
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Some information about this general settings option </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Allow mail redirect
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Other sets of options are available </p>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Expose author name in posts
            <input type="checkbox" class="pull-right" checked>
            </label>
            <p> Allow the user to show his name in blog posts </p>
          </div>
          <!-- /.form-group -->
          <h3 class="control-sidebar-heading">Chat Settings</h3>
          <div class="form-group">
            <label class="control-sidebar-subheading"> Show me as online
            <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Turn off notifications
            <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <label class="control-sidebar-subheading"> Delete chat history <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a> </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="profile_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 450px; margin: 0 auto;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Profile Information</h4>
      </div>
      <div class="modal-body">
        <h4 align="center" id="notifyMsg"></h4>
        {{Form::hidden('id',Auth::user()->id)}}
        <div class="form-group row">
          {{Form::label('name', 'Name:', array('class' => 'col-md-4 control-label'))}}
          <div class="col-md-8">
              <input type="text" class="form-control" id="name" value="{{  Auth::user()->name  }}" name="name" placeholder="Name">
          </div>
        </div>
        <div class="form-group row">
          {{Form::label('oldPassword', 'Old Password', array('class' => 'col-md-4 control-label'))}}
          <div class="col-md-8">
              <input type="password" class="form-control" id="oldPassword" value="" name="exist_password" placeholder="Given old password">
              <input type="hidden" class="form-control" id="existPass" value="{{Auth::user()->password}}" name="old_password" placeholder="Given old password">
          </div>
        </div>
        <div class="form-group row">
          {{Form::label('newPass', 'New Password:', array('class' => 'col-md-4 control-label'))}}
          <div class="col-md-8">
              <input type="password" class="form-control" id="newPass" value="" name="password" placeholder="given new password">
          </div>
        </div>
        <div class="form-group row">
          {{Form::label('confirmPass', 'Confirm Password', array('class' => 'col-md-4 control-label'))}}
          <div class="col-md-8">
              <input type="password" class="form-control" id="confirmPass" value="" name="confirm_password" placeholder="confirm password">
              <span id="confirmMsg"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="btnSave" value="add">Update</button>
      </div>
    </div>
  </div>
</div>

{!!Html::script('public/custom/js/ams.js')!!}
</body>
</html>
