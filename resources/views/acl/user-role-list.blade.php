@extends('layouts.layout')
@section('title', 'User Role List')
@section('content')
<?php 
  use App\Library\ACL;
  $allControllerList = ACL::getAllController();
  asort($allControllerList);

  $add_edit = ACL::userWisePermissionSelection('add_edit');
  $delete = ACL::userWisePermissionSelection('delete');

?>
<section class="content-header">
  <h1><i class="fa fa-list"></i> User Role List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">User Role</li>
  </ol>
</section>

<section class="content">

  @include('common.message')

  <div class="box box-primary">

    <div class="box-header with-border" align="right">
      @if($add_edit==true)
      <a href="#addModal" class="btn btn-success" data-toggle="modal">
        <i class="fa fa-plus"></i> <b>Add New</b>
      </a> 
      @endif
      <a href="{{  url('user-role')  }}" class="btn btn-warning">
        <i class="fa fa-refresh"></i> <b>Refresh</b>
      </a> 
    </div>

    <div class="box-body">
      
      <div class="table_scroll">
        <table class="table table-bordered table-striped table-responsive">
              <th>S/L</th>
              <th>User Role</th>
              <th>Action</th>
          <tbody>
            <?php                           
              $number = 1;
              $numElementsPerPage = 10; // How many elements per page
              $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
            ?>
            @if(isset($alldata) && count($alldata))
              @foreach($alldata as $data)
                <tr>
                  <td><label class="label label-success">{{$currentNumber++}}</label></td>
                  <td>{{  $data->role_name  }}</td>
                  <td>
                    <div class="form-inline">
                        @if($add_edit==true)
                        <div class = "input-group">
                          <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                        </div>
                        @endif
                        @if($delete==true)
                        <div class = "input-group"> 
                          {{Form::open(array('route'=>['user-role.destroy',$data->id],'method'=>'DELETE'))}}
                            <button type="submit" confirm="Are you sure you want to delete this User Role ?" class="btn btn-danger btn-xs confirm" title="Delete" style="padding: 1px 9px;">Delete</button>
                          {!! Form::close() !!}
                        </div>
                        @endif
                    </div>

                    @if($add_edit==true)
                    <!-- Modal Start -->
                      <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i> Update User Role and Access</h4>
                            </div>
                              {!! Form::open(array('route' => ['user-role.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                            <div class="modal-body">

                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="role_name">User Role: </label>
                                    <input type="text" class="form-control" value="{{  $data->role_name  }}" name="role_name" placeholder="Enter User Role" required>
                                  </div>
                              </div>

                              <?php 
                                $accessController = json_decode($data->user_role, true);
                              ?>
                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="user_access">User Role Wise Permission: </label>
                                    <table class="table table-responsive table-striped table-bordered">
                                    <?php $j=0; ?>
                                    @foreach($getControllerList as $key => $accessName)
                                    <?php 
                                        $mainCheck = $viewCheck = $addEditCheck = $deleteCheck = ""; 
                                        $subCheckStatus = 'disabled="disabled"';
                                        if(isset($accessController[$accessName->full_name])){
                                          $mainCheck = "checked";
                                          $subCheckStatus = "";
                                          $arr = $accessController[$accessName->full_name];
                                          if(isset($arr['view'])){
                                            $viewCheck = "checked";
                                          }
                                          if(isset($arr['add_edit'])){
                                            $addEditCheck = "checked";
                                          }
                                          if(isset($arr['delete'])){
                                            $deleteCheck = "checked";
                                          }
                                        }
                                    ?>
                                    <tr>
                                      <td>
                                        <label class="checkbox-inline">
                                          <input type="checkbox" class="updateMainCheckbox" id="{{$data->id}}_updateMainCheckbox_{{$j}}" name="access[{{$accessName->full_name}}][controller_name]" value="{{$accessName->full_name}}" {{$mainCheck}}> 
                                          <strong>{{$accessName->surname}}</strong>
                                        </label>
                                      </td>
                                      <td>
                                        <label class="checkbox-inline">
                                          <input type="checkbox" class="{{$data->id}}_subAction_{{$j}}" name="access[{{$accessName->full_name}}][view]" value="1" {{$subCheckStatus}} {{$viewCheck}}> View
                                        </label>

                                        <label class="checkbox-inline">
                                          <input type="checkbox" class="{{$data->id}}_subAction_{{$j}}" name="access[{{$accessName->full_name}}][add_edit]" value="1" {{$subCheckStatus}} {{$addEditCheck}}> Add / Edit
                                        </label>

                                        <label class="checkbox-inline">
                                          <input type="checkbox" class="{{$data->id}}_subAction_{{$j}}" name="access[{{$accessName->full_name}}][delete]" value="1" {{$subCheckStatus}} {{$deleteCheck}}> Delete
                                        </label>
                                      </td>
                                    </tr>
                                    <?php $j++; ?>
                                    @endforeach
                                    </table>
                                  </div>
                              </div>
                                  
                            </div>
                            <div class="modal-footer">
                              <div class="col-md-6">
                                <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100%">
                                  Close
                                </button>
                              </div>
                              <div class="col-md-6">
                                {{Form::submit('Update',array('class'=>'btn btn-warning', 'style'=>'width:100%'))}}
                              </div>
                            </div>
                              {!! Form::close() !!}
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div>
                    <!-- /.modal -->
                    @endif
                  </td>
                </tr>
              @endforeach
              @else
              <tr>
                <td colspan="3" align="center"> No Data Found</td>
              </tr>
              @endif
          </tbody>
        </table>
        <div align="center">{{ $alldata->render() }}</div>
      </div>

    </div>

    <div class="box-footer"> </div>

  </div>
</section>

@if($add_edit==true)
<!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus-square" style="color: green"></i> Add New User Role and Access</h4>
        </div>
          {!! Form::open(array('route' => ['user-role.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="modal-body">
          
          <div class="form-group">
              <div class="col-md-12">
                <label for="role_name">User Role: </label>
                <input type="text" class="form-control" id="" value="" name="role_name" placeholder="Enter User Role" required>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-12">
                <label for="user_access">User Role Wise Permission: </label>
                <table class="table table-responsive table-striped table-bordered">
                <?php $i=1; ?>
                @foreach($getControllerList as $key => $accessName)
                <tr>
                  <td>
                    <label class="checkbox-inline">
                      <input type="checkbox" class="mainCheckbox" id="mainAction_{{$i}}" name="access[{{$accessName->full_name}}][controller_name]" value="{{$accessName->full_name}}"> 
                      <strong>{{$accessName->surname}}</strong>
                    </label>
                  </td>
                  <td class="" style="">
                    <label class="checkbox-inline">
                      <input type="checkbox" class="subAction_{{$i}}" name="access[{{$accessName->full_name}}][view]" value="1" disabled="disabled"> View
                    </label>

                    <label class="checkbox-inline">
                      <input type="checkbox" class="subAction_{{$i}}" name="access[{{$accessName->full_name}}][add_edit]" value="1" disabled="disabled"> Add / Edit
                    </label>

                    <label class="checkbox-inline">
                      <input type="checkbox" class="subAction_{{$i}}" name="access[{{$accessName->full_name}}][delete]" value="1" disabled="disabled"> Delete
                    </label>
                  </td>
                </tr>
                <?php $i++; ?>
                @endforeach
                </table>
              </div>
          </div>
 
        </div>
        <div class="modal-footer">
          <div class="col-md-6">
            <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100%">Close</button>
          </div>
          <div class="col-md-6">
            {{Form::submit('Save',array('class'=>'btn btn-success', 'style'=>'width:100%'))}}
          </div>  
        </div>
          {!! Form::close() !!}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
<!-- /.modal -->
@endif

<script type="text/javascript">
  $(".mainCheckbox").click(function(){
      var idArr = (this.id).split('_'); 
      if($(this).prop('checked')==true){
        $(".subAction_"+idArr[1]).removeAttr('disabled');
      }else{
        $(".subAction_"+idArr[1]).prop("checked", false).attr('disabled', 'disabled');
      }
  });

  $(".updateMainCheckbox").click(function(){
      var idArr = (this.id).split('_'); 
      if($(this).prop('checked')==true){
        $("."+idArr[0]+"_subAction_"+idArr[2]).removeAttr('disabled');
      }else{
        $("."+idArr[0]+"_subAction_"+idArr[2]).prop("checked", false).attr('disabled', 'disabled');
      }
  });
</script>

@endsection 