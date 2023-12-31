@extends('layouts.master')
@section('heading')
<div class="content-header">
    <div class="container-fluid">
        <!-- Heading -->
        <!-- ... -->
    </div>
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Playlist</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('playlist.update', $playlist->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="{{ $playlist->name }}" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Playlist</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Video List</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="video_ids">Videos</label>
                        <select class="form-control select2" name="video_ids[]" multiple >
                            @foreach($videos as $video)
                            <option value="{{ $video->id }}" {{ $playlist->videos->contains($video->id) ? 'selected' : '' }}>
                                {{ $video->video_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection