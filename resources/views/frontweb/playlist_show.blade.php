@extends('layouts.frontweb')
@section('body')


<!-- start of most watch -->
<div class="small-header anim" style="--delay: .1s">{{$playlists->name}}</div>



<div class="videos mb-5">
  <?php $x = 2; ?>
  @foreach($videos as $row) 
  <?php $x++ ?>
  <!-- to loop -->
 <div class="video anim" style="--delay: .<?php echo $x ?>s; padding-bottom: 10px" onclick="window.location.href = '{{ route('stream.show', ['id' => $row['id']]) }}'">
<div class="video-name" onclick="window.location.href = '{{ route('stream.show', ['id' => $row['id']]) }}'">{{ $row['video_name'] }}</div>
</div>
<!-- end loop -->

@endforeach

<div class="video anim " style="--delay: .<?php echo $x ?>s; background-color: transparent; margin-top: 10px">
<div class="video-name" style="background-color: transparent"></div>
</div>


</div> <!-- end of most watch -->













@endsection