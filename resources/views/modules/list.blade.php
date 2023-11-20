@extends('layouts.master')

@section('heading')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">MODULES MANAGER</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">MODULE</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection



@section('body')

<section class="col-lg-12 connectedSortable">
 <div class="card">
    <div class="card-header">
      <h3 class="card-title">MODULE LIST</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-block btn-light btn-xs" onclick="ModuleModes(this)"  id="x" >Add Module</button>
                </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body pt-1">
      <table id="transfertable" class="table table-sm table-striped ">
        <thead>
          <tr> 
                        <th>#</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Route</th>
                        <th>Default Url</th>
                        <th>Icon</th>
                        <th>Action</th> 
          </tr>
        </thead>
        <tbody>
                   @forelse($modules as $module)
                      <tr>
                        <td>{!! $module->id !!}</td>
                        <td>{!! $module->module !!}</td>
                        <td>{!! $module->description !!}</td>
                        <td>{!! $module->routeUri !!}</td>
                        <td>{!! $module->default_url !!}</td>
                        <td>{!! $module->icon !!}</td>
                        <td>
                        <button type="button" class="btn btn-success btn-xs" id="{{$module->id}}" onclick="ModuleModes(this)"><i class="fa fa-pencil"></i></button>                                                                                                      
                        <button type="button" class="btn btn-danger btn-xs" id="{{$module->id}}" onclick="del(this)"><i class="fa fa-trash"></i></button>







                        </td>
                      </tr>
                    @empty
                    @endforelse
        </tbody>
        <tfoot>
          <tr>
                        <th>#</th>
                        <th>Module</th>
                        <th>Description</th>
                        <th>Route</th>
                        <th>Default Url</th>
                        <th>Icon</th>
                        <th>Action</th>  
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</section>
<!-- edit base on design -->

@include('modules.module_modal')
@endsection











@section('extra_head')

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection
@section('extra_script')


<!-- DataTables  & Plugins -->
<script src="{{asset('assets/panel/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/panel/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>

  $(function () {
    $("#transfertable").DataTable({
      "paging": true,"lengthChange": false,"searching": true,"ordering": false,"info": true,"autoWidth": true,"responsive": false,
      /*"buttons": ["copy", "csv", "excel", "pdf", "print"]*/
    }).buttons().container().appendTo('#transfertable_wrapper .col-md-6:eq(0)');
  });

</script>

<script type="text/javascript">



function ModuleModes(elem){
    var x = elem.id;

if( x == 'x'){
        document.getElementById("titlehead").innerHTML = "Create Module" ;  
        document.getElementById("action_button").value = "Create"; 
        $('#ids').val(x);
        $('#addModal').modal('show');



}
  else{

        $.ajax({
    type: "GET",
    url:"modules/edit/"+x  ,
    data:{id:x},
    success: function(response){
        document.getElementById("titlehead").innerHTML = "Update Module" ;  
        document.getElementById("action_button").value = "Update"; 
        $('#addModal').modal('show');
        $('#ids').val(response.modules.id);
        $('#mods').val(response.modules.module);
        $('#icon').val(response.modules.icon);
        $('#desc').val(response.modules.description);
        $('#ruri').val(response.modules.routeUri);
        $('#durl').val(response.modules.default_url);

    }

});

  }

}





</script>
@endsection