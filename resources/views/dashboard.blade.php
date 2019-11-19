@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> PMS Dashboard <small></small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  @include('common.message')
 <h1 align="center">Welcome to {{Auth::User()->name}}</h1>
 <h3 align="center">User Role:  <strong>{{Auth::User()->user_role_object->role_name}}</strong></h3>


</section>
<!-- chart -->

<!-- /.content -->
@endsection 