@extends('layouts.master')
@section('heading')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">SALARY ADJUSTMENT</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Deduction</li>
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
          <h3 class="card-title">Lists</h3>
          <div class="card-tools">
             
         </div>
         <!-- tools card -->
     </div>
     <!-- /.card-header -->
     <div class="card-body pt-1">
      <table id="transfertable" class="table table-sm table-striped ">
        <thead>
          <tr> 
            <th>uuid</th> 
            <th>payload</th>                                   
            
        </tr>
    </thead>
    <tbody>

         @foreach($jobs as $adj)
        
         <?php

         $data = json_decode($adj->payload);

       


     ?>
                                    <tr>                                      
                                        
                                       <td>{{$data->uuid}}</td>
                                       <td>{{$data->data->command}}</td>

                                    </tr>
                                 @endforeach
       
    </tbody>
   
</table>
</div>
<!-- /.card-body -->
</div>
</section>

<!-- Modal -->
<div class="modal fade" id="addEmplModal">
    <div class="modal-dialog">
      <div class="modal-content">
        {!! Form::open(array('route'=>'sadjust.add','method'=>'POST')) !!}
        <div class="modal-header">
          <h4 class="modal-title">Adjustment Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
 
   
</div>
<div class="modal-footer justify-content-between">
  <button type="submit" class="btn btn-primary">Save</button>
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
      /*      "buttons": ["copy", "csv", "excel", "pdf", "print"]*/
  }).buttons().container().appendTo('#transfertable_wrapper .col-md-6:eq(0)');
});
</script>
<script type="text/javascript">
    function typeEditFunction(elem){
        var x = elem.id;
        $.ajax({
            url: "{{Route('deduction_details')}}",
            type:"POST",
            data: {type_id: x},
            success: function(data){            
             $('#type_name').val(data['description']); 
             $('#company').val(data['company_code']);
             $('#branch_code').val(data['branch_code']);
             $('#allcode_code').val(data['deduction_code']);
             $('#amt').val(data['amount']);
             $('#allowance_id').val(data['id']);  
             $('#status option[value="'+data['status']+'"]').attr("selected", "selected");                   
             $('#editTypeModal').modal('show');
         }    
     });
    }
    function applyemploye(){
       $('#addEmplModal').modal('show');
   }
</script>
@endsection