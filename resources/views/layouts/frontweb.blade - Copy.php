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
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>New Muslim Library</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel='stylesheet' href='https://vjs.zencdn.net/5-unsafe/video-js.css'>
  <link rel="stylesheet" href="{{asset('vid_assest/style.css')}}">
</head>
<body >
  <div id="fb-root"></div>
  <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
  <!-- partial:index.partial.html -->
  <div class="container">



   <div class="sidebar">
    <span class="logo">S</span>
    <a class="logo-expand" href="{{route('web.playlist')}}"><img src="{{asset('logo.png')}}" alt="YouTube Logo" class="youtube-logo"  /></a>
    <div class="side-wrapper">
     <div class="side-title">MENU</div>
     <div class="side-menu">
      <a class="sidebar-link discover" href="{{route('web.playlist')}}">
       <svg viewBox="0 0 24 24" fill="currentColor">
        <path d="M9.135 20.773v-3.057c0-.78.637-1.414 1.423-1.414h2.875c.377 0 .74.15 1.006.414.267.265.417.625.417 1v3.057c-.002.325.126.637.356.867.23.23.544.36.87.36h1.962a3.46 3.46 0 002.443-1 3.41 3.41 0 001.013-2.422V9.867c0-.735-.328-1.431-.895-1.902l-6.671-5.29a3.097 3.097 0 00-3.949.072L3.467 7.965A2.474 2.474 0 002.5 9.867v8.702C2.5 20.464 4.047 22 5.956 22h1.916c.68 0 1.231-.544 1.236-1.218l.027-.009z" />
      </svg>
      Discover
    </a>
  </div> 
</div> 
</div>






<div class="wrapper">
  <div class="header">
   <div class="search-bar">
    <input type="text" placeholder="Search">
  </div>
</div>
<div class="main-container ">
  @yield('body')
</div>
</div>


</div> <!-- end of container -->

<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://vjs.zencdn.net/5-unsafe/video.js'></script><script  src="{{asset('vid_assest/script.js')}}"></script>
</body>
</html>
@endif