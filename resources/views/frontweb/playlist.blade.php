@extends('layouts.frontweb')
@section('body')


<!-- start of most watch -->
<div class="small-header anim" style="--delay: .1s">Playlists</div>



<div class="videos">
  <?php $x = 1; ?>
  @foreach($playlists as $playlist)
  <?php $x++ ?>
  <!-- to loop -->
 <div class="video anim" style="--delay: .<?php echo $x ?>s" onclick="window.location.href = '{{ route('playlist.videos', ['id' => $playlist->id]) }}'">
   <div class="video-time"></div>
   <div class="video-wrapper">
   
    <div class="author-img__wrapper video-author">
     <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
      <path d="M20 6L9 17l-5-5" />
    </svg>

  </div>
</div>

<div class="video-name" onclick="window.location.href = '{{ route('playlist.videos', ['id' => $playlist->id]) }}'">{{ $playlist->name }}</div>

</div>
<!-- end loop -->
@endforeach
</div> <!-- end of most watch -->













@endsection