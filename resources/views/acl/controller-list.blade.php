@extends('layouts.layout')
@section('title', 'Controller List List')
@section('content')

<section class="content-header">
  <h1><i class="fa fa-list"></i> Controller List List</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Controller List</li>
  </ol>
</section>

<section class="content">

  @include('common.message')

  <div class="box box-primary">

    <div class="box-header with-border" align="right">
     
      <a href="#addModal" class="btn btn-success" data-toggle="modal">
        <i class="fa fa-plus"></i> <b>Add New</b>
      </a> 
     
      <a href="{{  url('all-controller-list')  }}" class="btn btn-warning">
        <i class="fa fa-refresh"></i> <b>Refresh</b>
      </a> 
    </div>

    <div class="box-body">
      
      <div class="table_scroll">
        <table class="table table-bordered table-striped table-responsive">
              <th>S/L</th>
              <th>Controller Name</th>
              <th>Sur Name</th>
              <th>Action</th>
          <tbody>
            <?php                           
              $number = 1;
              $numElementsPerPage = 10; // How many elements per page
              $pageNumber = isset($_GET['page']) ? (int)$_GET['page'] : 1;
              $currentNumber = ($pageNumber - 1) * $numElementsPerPage + $number;
            ?>
            @if(isset($allControllerListJson))
              @foreach($allControllerList as $data)
                <tr>
                  <td><label class="label label-success">{{$currentNumber++}}</label></td>
                  <td>{{  $data->full_name  }}</td>
                  <td>{{  $data->surname  }}</td>
                  <td>
                    <div class="form-inline">
                        <div class = "input-group">
                          <a href="#editModal{{$data->id}}" class="btn btn-primary btn-xs" data-toggle="modal" style="padding: 1px 15px;">Edit</a>
                        </div>
                        
                    </div>

                    
                    <!-- Modal Start -->
                      <div class="modal fade" id="editModal{{$data->id}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"><i class="fa fa-edit" style="color:#E08E0B"></i> Update Controller Sur Name</h4>
                            </div>
                              {!! Form::open(array('route' => ['all-controller-list.update', $data->id],'class'=>'form-horizontal','method'=>'PUT')) !!}
                            <div class="modal-body">
                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="user_access">Controller Full Name: </label>
                                    <input type="text" name="" value="{{$data->full_name}}" class="form-control" readonly>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-md-12">
                                    <label for="user_access">Sur Name: </label>
                                    <input type="text" name="surname" value="{{$data->surname}}" class="form-control">
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
      </div>

    </div>

    <div class="box-footer"> </div>

  </div>
</section>

<!-- Modal -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content" style="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-plus-square" style="color: green"></i> Add New Controller List</h4>
        </div>
          {!! Form::open(array('route' => ['all-controller-list.store'],'class'=>'form-horizontal','method'=>'POST')) !!}
        <div class="modal-body">
          

          <div class="form-group">
              <div class="col-md-12">
                <label for="user_access">Controller List: </label>
                <table class="table table-responsive table-striped table-bordered">
                <?php $i=1; ?>
                @foreach($getControllerName as $controllerName => $accessName)
                <?php
                    $checkController = DB::table('controller_name')->where('full_name',$controllerName)->first();
                ?>
                @if(empty($checkController))
                <tr>
                  <td>
                    <label class="checkbox-inline">
                      <input type="checkbox" class="mainCheckbox" id="mainAction_{{$i}}" name="access[{{$controllerName}}][controller_name]" value="{{$controllerName}}"> 
                      <strong>{{$accessName}}</strong>
                    </label>
                  </td>
                  <td class="" style="">
                    <label class="checkbox-inline">
                      <input type="text" class="subAction_{{$i}} form-cotrol" name="access[{{$controllerName}}][sur_name]" disabled="disabled">
                    </label>

                    
                  </td>
                </tr>
                @endif
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