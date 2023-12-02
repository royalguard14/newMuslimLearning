@extends('layouts.frontweb')
@section('body')

<script type="text/javascript">
window.onload = function() {
  $(".sidebar-link").removeClass("is-active");
  $(".local").addClass("is-active");
};
</script>

<div class="main-header anim" style="--delay: 0s">Discover</div>
<!-- top 2 fe-->
<div class="main-blogs">
  <div class="main-blog anim" style="--delay: .1s">
   <div class="main-blog__title">Quran</div>
 </div>
 <div class="main-blog anim" style="--delay: .2s">
   <div class="main-blog__title">Mosques & Center</div>
 </div>
</div> <!-- end top 2 fe-->
<!-- start of most watch -->
<div class="small-header anim" style="--delay: .3s">Uploaded Videos</div>
<div class="videos">
  <?php $x = 3; ?>
  @foreach($videos as $row) 
  <?php $x++ ?>
  <!-- to loop -->
  <div class="video anim" style="--delay: .<?php echo $x ?>s">
   <div class="video-time"></div>
   <div class="video-wrapper">
    <video muted="">
     <source src="{{asset('storage/uploads/' . $row['video_path'])}}" type="video/mp4">
     </video>
     <div class="author-img__wrapper video-author">
       <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check">
        <path d="M20 6L9 17l-5-5" />
      </svg>
      <img class="author-img" src="https://images.pexels.com/photos/1680172/pexels-photo-1680172.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" />
    </div>
  </div>
  <div class="video-by">Andy William</div>
  <div class="video-name" onclick="window.location.href = '{{ route('stream.show', ['id' => $row['id']]) }}'">{{ $row['video_name'] }}</div>
  <div class="video-view">{{ $row['views'] }} views<span class="seperate video-seperate"></span>{{ $row['created_at']->diffForHumans() }}</div>
</div>
<!-- end loop -->
@endforeach
</div> <!-- end of most watch -->
@endsection