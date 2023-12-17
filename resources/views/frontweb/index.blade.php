@extends('layouts.playlist')
@section('body')
@if(count($playlists) > 0)
    @foreach($playlists as $playlist)
        <li class="playlist-list-item">
            <a href="{{ route('playlist.videos', ['id' => $playlist->id]) }}">{{ $playlist->name }}</a>
        </li>
    @endforeach
@else
    <li class='playlist-list-item'>0 results</li>
@endif
@endsection