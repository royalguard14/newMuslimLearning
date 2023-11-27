<?php
$check = DB::table('designs')->where('id',2)->first();
$check2 = DB::table('designs')->where('id',26)->first();
$mainte = $check -> class;
$webmode = $check2 -> class;
use App\Models\VideoDetails;
?>
@if($mainte == 'off'  &&  $webmode == 'off')
@include('auth.login')
@elseif($mainte == 'on')
@include('chill')
@else
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="youtube.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <title>New Muslim Library</title>
</head>
<body>
  <div id="fb-root"></div>
  <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
  <header class="header" style="background-color: #363636;">
    <a href="{{route('main.web')}}">
      <img src="logo.png" alt="YouTube Logo" class="youtube-logo"  />
    </a>
    <form class="search-bar">
      <input class="search-input" type="search" placeholder="Search" aria-label="Search" />
      <button type="submit" class="search-btn">
        <img src="magnify.svg" />
      </button>
    </form>
    <div class="menu-icons">
      <a href="#">
        <img src="video-plus.svg" alt="Upload Video" />
      </a>
      <a href="#">
        <img src="apps.svg" alt="Apps" />
      </a>
      <a href="#">
        <img src="{{asset('bell.svg')}}" alt="Notifications" />
      </a>
      <a href="#">
        <img class="menu-channel-icon" src="http:///unsplash.it/36/36?gravity=center" alt="Your Channel" />
      </a>
    </div>
  </header>
<!--   <div class="categories">
    <section class="category-section">
      <button class="category active">All</button>
      <button class="category">Category 1</button>
    </section>
  </div> -->
  <div class="videos">
    <section class="video-section">
      <!-- Top random video -->
      @foreach($videosLocal as $row) 
      <?php $reg = DB::table('video_details')->where('vidlib_id',$row->id)->first();?>  
      <article class="video-container">
        <a href="#" class="thumbnail" data-duration="12:24">
          <video class="thumbnail-video" width="250" height="150" controls>
            <source src="{{asset('storage/uploads/' . $row->video_path)}}" type="video/mp4">
            </video>
          </a>
          <div class="video-bottom-section">
            <a href="#">
              <img class="channel-icon" src="http://unsplash.it/36/36?gravity=center" />
            </a>
            <div class="video-details">
             <a href="{{ route('stream.show', ['id' => $row->id]) }}" class="video-title">{{ $row->video_name }}</a>
             <!--  <a href="#" class="video-channel-name">Channel Name</a> -->
             <div class="video-metadata">
              <span>Views: {{$reg->views}}</span>
              •
              <span> {{ $row['created_at']->diffForHumans() }}</span> 
            </div>
          </div>
        </div>
      </article>
      @endforeach
    </section>
    <section class="video-section">
      <h2 class="video-section-title">
        Facebook Videos
        <button class="video-section-title-close">&times;</button>
      </h2>
      @foreach($facebookSrc as $row) 
      <?php $reg = DB::table('video_details')->where('vidlib_id',$row['id'])->first();?>   
      <article class="video-container">
        <div class="youtube-video">
          <iframe 
          src="{{ $row['src'] }}" 
          width="250" 
          height="150" 
          style="border:none;overflow:hidden" 
          scrolling="no" 
          frameborder="0" 
          allowfullscreen="true" 
          allow="autoplay; clipboard-write;  picture-in-picture; " 
          allowFullScreen="true"></iframe>
        </div>
        <div class="video-bottom-section">
          <a href="#">
            <img class="channel-icon" src="http://unsplash.it/36/36?gravity=center" />
          </a>
          <div class="video-details">
            <a href="{{ route('stream.show', ['id' => $row['id']]) }}" class="video-title">{{ $row['video_name'] }}</a>               <!-- <a href="#" class="video-channel-name">Official Channel</a> -->
            <div class="video-metadata">
              <span>Views: {{$reg->views}}</span>
              •
              <span> {{ $row['created_at']->diffForHumans() }}</span> <!-- Show date from created_at -->
            </div>
          </div>
        </div>
      </article>
      @endforeach
    </section>
    <section class="video-section">
      <h2 class="video-section-title">
        Youtube Videos
        <button class="video-section-title-close">&times;</button>
      </h2>
      @foreach($youtubeSrc as $row)
      <?php $reg = DB::table('video_details')->where('vidlib_id',$row['id'])->first();?>    
      <article class="video-container">
        <div class="youtube-video">
          <iframe 
          width="250" 
          height="150" 
          src="{{ $row['src'] }}" 
          frameborder="0" 
          allowfullscreen></iframe>
        </div>
        <div class="video-bottom-section">
          <a href="#">
            <img class="channel-icon" src="http://unsplash.it/36/36?gravity=center" />
          </a>
          <div class="video-details">
            <a  class="video-title" href="{{ route('stream.show', ['id' => $row['id']]) }}" >{{ $row['video_name'] }}</a>
            <!-- <a href="#" class="video-channel-name">Official Channel</a> -->
            <div class="video-metadata">
              <span>Views: {{$reg->views}}</span>
              •
              <span> {{ $row['created_at']->diffForHumans() }}</span> <!-- Show date from created_at -->
            </div>
          </div>
        </div>
      </article>
      @endforeach
    </section>
  </div>
</body>
</html>
@endif