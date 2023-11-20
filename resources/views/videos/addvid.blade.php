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
<div class="row">
    <section class="col-lg-5 connectedSortable">
        <!-- Left side with video and optional PDF upload -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload Video Here</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('video.store') }}" method="POST">
                  @csrf
                    <!-- Video Upload input -->
                    <div class="form-group">
                        <label for="videoUpload">Select MP4 Video</label>
                        <input type="file" class="form-control-file" id="videoUpload" accept=".mp4" name="videoUpload">
                    </div>
                    
                    <!-- Video Player -->
                    <div class="form-group" id="videoPlayer" style="display: none;">
                        <video id="uploadedVideo" controls style="width: 100%; max-height: 300px;"></video>
                    </div>
                    
                    <!-- Progress bar -->
                    <div class="progress" style="display: none;">
                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <!-- Optional PDF upload -->
                    <hr>
                    <div class="form-group">
                        <label for="pdfUpload">Select PDF File (Optional)</label>
                        <input type="file" class="form-control-file" name="pdfUpload" accept=".pdf">
                    </div>
            </div>
              <button type="submit" class="btn btn-primary" >Upload</button>
        </div>
    </section>

    <!-- Right side with video title and description -->
    <section class="col-lg-7 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Video Title & Description</h3>
            </div>
            <div class="card-body">
                <!-- Video Title input -->
                <div class="form-group">
                    <label for="videoTitle">Video Title</label>
                    <input type="text" class="form-control" name="videoTitle" placeholder="Enter video title">
                </div>
                
                <!-- Video Description textarea -->
                <div class="form-group">
                    <label for="videoDescription">Video Description</label>
                    <textarea class="form-control" id="videoDescription" name="videoDescriptions" rows="5" placeholder="Enter video description"></textarea>
                </div>
            </div>
        </div>
    </section>
             <!-- Upload button -->
                  
                </form>
</div>
@endsection

@section('extra_head')

@endsection

@section('extra_script')
<script type="text/javascript">
 document.getElementById('videoUpload').addEventListener('change', function(event) {
    const fileInput = event.target;
    const videoPlayer = document.getElementById('videoPlayer');
    const videoElement = document.getElementById('uploadedVideo');
    const progress = document.querySelector('.progress');
    const progressBar = document.querySelector('.progress-bar');

    if (fileInput.files && fileInput.files[0]) {
        const file = fileInput.files[0];
        const fileURL = URL.createObjectURL(file);

        videoElement.src = fileURL;
        videoPlayer.style.display = 'block';

        const formData = new FormData();
        formData.append('video', file);

        const xhr = new XMLHttpRequest();

        // xhr.open('POST', '{{ route("video.store") }}', true);

        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                progressBar.style.width = percentComplete + '%';
                progressBar.setAttribute('aria-valuenow', percentComplete);
            }
        };

        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Upload successful');
            } else {
                console.error('Upload failed');
            }
        };

        xhr.send(formData);
        progress.style.display = 'block';
    } else {
        videoPlayer.style.display = 'none';
    }
});

document.querySelector('form').addEventListener('submit', function(event) {
    const videoInput = document.getElementById('videoUpload');
    const titleInput = document.querySelector('input[name="videoTitle"]');
    const descriptionInput = document.querySelector('textarea[name="videoDescriptions"]');

    if (!videoInput.files.length || !titleInput.value.trim() || !descriptionInput.value.trim()) {
        event.preventDefault(); // Prevent form submission
        alert('Please fill in all required fields (Video, Title, Description) before uploading.');
    }
});
</script>
@endsection
