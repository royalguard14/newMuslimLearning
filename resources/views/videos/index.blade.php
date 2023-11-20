@extends('layouts.master')
@section('heading')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Library</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Library</li>
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
      <h3 class="card-title">Videos</h3>
      <div class="card-tools">
        <!-- button with a dropdown -->
        <div class="btn-group">
          <button type="button" class="btn btn-block btn-light btn-xs" onclick="window.location.href = '{{ route('video.create') }}'">Upload Video</button>


        </div>
      </div>
      <!-- tools card -->
    </div>
    <!-- /.card-header -->
    <div class="card-body pt-1">
      <table id="transfertable" class="table table-sm table-striped ">
        <thead>
          <tr> 
            <tr>
              <th>no.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Details</th>
              <th>Action</th>
            </tr>
          </tr>
        </thead>
        <tbody>
          <?php $x = 1; ?>
          @foreach($videos as $row)   
          <?php $reg = DB::table('video_details')->where('vidlib_id',$row->id)->first();?> 
          <tr>
            <td style="vertical-align: middle; text-align: center;">{{$x++;}}</td>

            <td style="vertical-align: middle; max-width: 300px; overflow: hidden;">{{strtoupper($row->video_name)}}</td>
            <td style="vertical-align: middle; max-width: 300px; overflow: hidden;">
              @php
              $description = $row->description;
              $maxLength = 100;
              @endphp
              @if(strlen($description) > $maxLength)
              <span class="short-text">{{ \Illuminate\Support\Str::limit($description, $maxLength, '...') }}</span>
              <span class="full-text" style="display: none;">{{ $description }}</span>
              <a href="#" class="read-more">Read More</a>
              @else
              {{ $description }}
              @endif
            </td>

            <td style=" vertical-align: middle;"> 
              <span>Views:</span> <em>{{$reg->views}}</em><br>
              <span>Thumb Up:</span> <em>{{$reg->likes}}</em><br>
              <span>Thumb Down:</span> <em>{{$reg->dislikes}}</em><br>
              <span>Download:</span> <em>{{$reg->downloads}}</em><br>
              <?php $uploader = DB::table('users')->where('id',$reg->uploader)->first();?> 
              <span>Uploaded by:</span> <em>{{$uploader->username}}</em><br>
            </td>
            <td style=" vertical-align: middle;">
              <button type="button" class="btn btn-success btn-m" id="{{$row->id}}" onclick="edit('{{$row->id}}')" ><i class="fa fa-pencil"></i></button>
                                                                                            
              <button type="button" class="btn btn-danger btn-m" onclick="del('{{$row->id}}')"><i class="fa fa-trash"></i></button>                            
            </td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <tr>
              <th>no.</th>
              <th>Title</th>
              <th>Description</th>
              <th>Details</th>
              <th>Action</th>
            </tr>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</div>


<!-- /.modal -->
<div id="editModal" class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Title</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Video Title input -->
        <input type="hidden" name="ids" id="ids">
        <div class="form-group">
          <label for="videoTitle">Video Title</label>
          <input type="text" class="form-control" name="videoTitle"  id="videoTitle" placeholder="Enter video title">
        </div>

        <!-- Video Description textarea -->
        <div class="form-group">
          <label for="videoDescription">Video Description</label>
          <textarea class="form-control" id="videoDescription" name="videoDescriptions" rows="5" placeholder="Enter video description"></textarea>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-block  btn-lg btn-success" id="editNow">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


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
      // "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#transfertable_wrapper .col-md-6:eq(0)');
  });
</script>


<script>
  $(document).ready(function() {
    $('.read-more').on('click', function(e) {
      e.preventDefault();
      var $shortText = $(this).siblings('.short-text');
      var $fullText = $(this).siblings('.full-text');

      $shortText.toggle();
      $fullText.toggle();

      if ($(this).text() === 'Read More') {
        $(this).text('Read Less');
      } else {
        $(this).text('Read More');
      }
    });
  });
</script>


<script type="text/javascript">
  function del(x){
   $.ajax({
    url: "{{ route('video.destroy') }}",
    type:"POST",
    data: {id:x},
    success: function(data){            
      location.reload(true);
    }    
  });
 }
</script>

<script type="text/javascript">
  function edit(x){

   $.ajax({
    url: "{{ route('video.show', '') }}" + "/" + x,
    type:"GET",
    data: {id:x},
    success: function(data){            
      $('#editModal').modal('show');
      $('#ids').val(data.video.id);
      $('#videoTitle').val(data.video.video_name);
      $('#videoDescription').val(data.video.description);

    }    
  });
 }
</script>


<script type="text/javascript">
  
$(document).ready(function() {
  $('#editNow').on('click', function() {
    
  var id = $('#ids').val();
  var videoTitle = $('#videoTitle').val();
  var videoDescription = $('#videoDescription').val();
   $.ajax({
    url: "{{ route('video.edit') }}",
    type:"POST",
    data: {id:id,
      videoTitle:videoTitle,
      videoDescription:videoDescription},
    success: function(data){            
    location.reload(true);
    }    
  });



  });
});

</script>



@endsection