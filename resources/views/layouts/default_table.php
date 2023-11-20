@extends('layouts.master')

@section('heading')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Payroll</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">generate</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection



@section('body')
<div class="col-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Types Table</h3>

      <div class="card-tools">
        <!-- button with a dropdown -->
        <div class="btn-group">
          <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
            <i class="fas fa-bars"></i>
          </button>
          <div class="dropdown-menu" role="menu">
            <a href=""  data-toggle="modal" data-target="#transfer_Modal" class="dropdown-item"  onclick="transfer()">Create</a>
            <div class="dropdown-divider"></div>
            <a href=""  data-toggle="modal" data-target="#editModal" class="dropdown-item" onclick="update(this)">Upload</a>
          </div>
        </div>
        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
      <!-- tools card -->
    </div>
    <!-- /.card-header -->
    <div class="card-body pt-1">
      <table id="transfertable" class="table table-sm table-striped ">
        <thead>
          <tr> 
            <th>Employee ID</th> 
          </tr>
        </thead>
        <tbody>
          @foreach($data as $row)


          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Employee ID</th>  
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>   


@endsection

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Types Table</h3>
  </div>
  <div class="card-body pt-1">
  </div>
  <div class="card-footer">
  </div>
</div>




















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
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#transfertable_wrapper .col-md-6:eq(0)');
  });

</script>

@endsection