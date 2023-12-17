@extends('layouts.playlist')
@section('body')
@if(count($videos) > 0)
@foreach($videos as $row)
<li class="playlist-list-item">
	<a href="{{ route('stream.show', ['id' => $row['id']]) }}">{{ $row['video_name'] }}</a>
</li>
@endforeach
@else
<li class='playlist-list-item'>0 results</li>
@endif
@endsection