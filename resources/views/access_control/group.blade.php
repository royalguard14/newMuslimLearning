@extends('layouts.master')
@section('heading')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">ADMIN TOOLS</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Access Control</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<?php
$users=[];
$design = DB::table('designs')->where('id',1)->first();
if ($design->class == 'dark-mode') {
  $mode = 'checked';
}
else{
  $mode = '';
}

$design = DB::table('designs')->where('id',26)->first();
if ($design->class == 'on') {
  $websiteswitch = 'checked';
}
else{
  $websiteswitch = '';
}


$design = DB::table('designs')->where('id',2)->first();
if ($design->class == 'on') {
  $menteswitch = 'checked';
}
else{
  $menteswitch = '';
}


?>
@endsection
@section('body')
<div class="row">
  <div class="col-lg-8">
    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">ROLES AND FUNCTIONS</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-block btn-light btn-xs" onclick="addrole(this)">Add Role</button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Register</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($access as $row)   
              <?php $reg = DB::table('users')->where('role',$row->id)->count();?> 
              <tr>
                <td>{{$row->id}}</td>
                <td id="name_group">{{strtoupper($row->group)}}</td>
                <td>{{$reg}}</td>
                <td>
                  <button type="button" class="btn btn-success btn-xs" id="{{$row->id}}" onclick="editaccess(this)" ><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btn btn-info btn-xs" id="{{$row->id}}" onclick="usersaccess(this)"><i class="fa fa-eye"></i></button>                                                                                           
                  <button type="button" class="btn btn-warning btn-xs" id="{{$row->id}}" onclick="addaccess(this)"><i class="fa fa-plus"></i></button>
                  <button type="button" class="btn btn-danger btn-xs" id="{{$row->id}}" onclick="del(this)"><i class="fa fa-trash"></i></button>                            
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-lg-4">
    <div class="card">
        <div class="card-header" >
          <div>
          <h3 class="card-title">Configuaration</h3>
          </div>

        </div>
            {!! Form::open(array('route'=>'design','method'=>'POST')) !!}      
        <div class="card-body">
        
        </div>                    
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Apply</button>
        </div>
           {!!Form::close()!!}
      </div>
    </div>
  </div>
<!-- Modal -->
<div id="editAccessModal" class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    {!! Form::open(array('route'=>'role.store','method'=>'POST')) !!}
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Member List</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="row" id="ajax_payslip">
       </div>
     </div>
     <div class="modal-footer justify-content-between">
      {!! Form::button('Close', ['class' => 'btn btn-default','data-dismiss' => 'modal',]) !!}
      {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
    </div>
    {!!Form::close()!!}
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="userAccessModal" class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Member List</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="ajax_users">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div id="useraddAccessModal" class="modal fade" id="modal-default">
  <div class="modal-dialog">
    {!! Form::open(array('route'=>'role.store','method'=>'POST')) !!}
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">USERS LIST</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
      
          {!! Form::select('cc[]',$users,'',['class'=>'select2bs4','multiple'=>'multiple','required'=>'required','data-placeholder'=>'Select a here','style'=>'width: 100%; color: green']) !!} 
        </div>  
      </div>
      <div class="modal-footer justify-content-between">
        {!! Form::hidden('id','',['id'=>'accessid']) !!}    
        {!! Form::button('Close', ['class' => 'btn btn-default','data-dismiss' => 'modal',]) !!}
        {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
      </div>
      {!!Form::close()!!}
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="addrole">
  <div class="modal-dialog modal-sm">
    {!! Form::open(array('route'=>'role.store','method'=>'POST')) !!}
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Register New Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="name_group" class="form-control" placeholder="Enter Role Name">
      </div>
      <div class="modal-footer float-right">
        <input type="hidden" name="user_id" value={{ Auth::id() }}>
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
    </div>
    <!-- /.modal-content -->
    {!!Form::close()!!}
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('extra_head')
@endsection
@section('extra_script')
<script src="{{asset('assets/panel/dist/js/demo.js')}}"></script>
<script type="text/javascript">
  function editaccess(elem){
    var x = elem.id;
    $.ajax({
      url: "{{ route('role.index') }}",
      type:"POST",
      data: {"_token": "{{ csrf_token() }}",
      "id": x},
      success: function(data){            
        $('#editAccessModal').modal('show');
        $('#ajax_payslip').empty().append(data);
      }    
    });
  }
</script>
<script>
  function usersaccess(elem){
    var x = elem.id;
    $.ajax({
      url: "{{ route('role.index') }}",
      type:"POST",
      data: {"id": x},
      success: function(data){            
        $('#userAccessModal').modal('show');
        $('#ajax_users').empty().append(data);
      }    
    });
  }
  function addaccess(elem){
    var x = elem.id;
    $('#accessid').val(x); 
    $('#useraddAccessModal').modal('show');
  }
</script>
<!-- Bootstrap Switch -->
<script src="{{asset('assets/panel/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script>
  $(function () { 
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'))
    })
  });
</script>
<script type="text/javascript">
  function addrole(){
    $('#addrole').modal('show');
  }
  function del(elem){
   var x = elem.id;
   $.ajax({
    url: "{{ route('role.delete') }}",
    type:"POST",
    data: {id:x},
    success: function(data){            
      location.reload(true);
    }    
  });
 }
</script>

@endsection
