
@extends('layouts.master')

@section('heading')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Playlist</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Playlist</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection



@section('body')
<style type="text/css">
    /* Custom styles for select2 */
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff;
    color: #fff;
}

/* Change the background color and text color for highlighted options */
.select2-container--default .select2-results__option[aria-selected="true"] {
    background-color: #007bff;
    color: #fff;
}

/* Change the background color and text color for available options */
.select2-container--default .select2-results__option[aria-selected="false"] {
    background-color: #fff;
    color: #000;
}

</style>

<div class="row">
<section class="col-lg-5 connectedSortable">
   <div class="card">
        <div class="card-header" >
          <div>
          <h3 class="card-title">Configuration</h3>
          </div>

        </div>
            {!! Form::open(array('route'=>'playlist.store','method'=>'POST')) !!}      
<div class="card-body">
    <label>Name</label>
    <input class="form-control" type="text" name="playlist_name">
    
    <label>Videos</label>
    <select class="form-control select2" name="video_ids[]" multiple>
        @foreach($videos as $video)
            <option value="{{ $video->id }}">{{ $video->video_name }}</option>
        @endforeach
    </select>
</div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Register Playlist</button>
        </div>
           {!!Form::close()!!}
      </div>
</section>
<!-- edit base on design -->
<section class="col-lg-7 connectedSortable">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Playlist</h3>

      <div class="card-tools">
        <!-- button with a dropdown -->

      </div>
      <!-- tools card -->
    </div>
    <!-- /.card-header -->
    <div class="card-body pt-1">
<table>
    <tbody>
        @foreach($playlists as $playlist)
            <tr> 
                <td>{{ $playlist->name }}</td>
                <td>
                    <button type="button" class="btn btn-primary" onclick="showModal({{ $playlist->id }})">
                        Videos List
                    </button>
                </td>
                                <td>
                   <a href="{{ route('playlist.edit', $playlist->id) }}" class="btn btn-warning">Edit Playlist</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>
    <!-- /.card-body -->
  </div>
 

</section>
</div>

<<!-- Modal for Playlist Videos -->
<div class="modal fade" id="playlistModal" tabindex="-1" role="dialog" aria-labelledby="playlistModalLabel" aria-hidden="true">
    <!-- Modal content -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="playlistModalLabel">Playlist Videos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="playlistVideosList">
                    <!-- Videos for the selected playlist will be displayed here -->
                </ul>
            </div>
            <div class="modal-footer">
      <!--           <button type="button" class="btn btn-primary" onclick="addVideoToPlaylist()">Add Video</button>
                <button type="button" class="btn btn-danger" onclick="deleteVideoFromPlaylist()">Delete Video</button> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection



















@section('extra_head')

<!-- DataTables -->
<link rel="stylesheet" href="{{asset('assets/panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/panel/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/panel/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

@endsection
@section('extra_script')

<script>
    function showModal(playlistId) {
        $.ajax({
            url: "{{ route('playlist.show', '') }}" + "/" + playlistId,
            type: 'GET',
            success: function(response) {
                var videos = response.videos;

                var $playlistVideosList = $('#playlistVideosList');
                $playlistVideosList.empty(); // Clear existing list
             videos.forEach(function(video, index) {
                var listItem = '<li>' + (index + 1) + '. ' + video.video_name + '</li>';
                $playlistVideosList.append(listItem);
            });

                // Show the modal
                $('#playlistModal').modal('show');
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Log any errors to the console
            }
        });
    }



</script>







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
      "paging": true,"lengthChange": false,"searching": true,"ordering": false,"info": true,"autoWidth": true,"responsive": false
    }).buttons().container().appendTo('#transfertable_wrapper .col-md-6:eq(0)');
  });

</script>

@endsection











