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
  <title>Choose a Playlist</title>
  <!-- Enable responsiveness -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #363636;
      color: #ffffff;
      font-family: Arial, sans-serif;
      padding-bottom: 30px; 
    }
    header {
      background-color: #363636;
      padding: 10px 0;
      text-align: center;
      color: #ffffff;
    }
    header img {
      max-width: 100%; /* Ensures the image fits within its container */
      height: auto;
    }
    /* Smaller logo size for mobile */
    @media (max-width: 768px) {
      header img {
        max-width: 150px; /* Adjust the maximum width for smaller screens */
      }
    }
    /* Footer styles */
    footer {
      background-color: #02999f;
      padding: 10px 0;
      text-align: center;
      color: #ffffff;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
    /* Glass card styles */
    .glass-card {
     background-color: #b0b0b0;
     border-radius: 10px;
     backdrop-filter: blur(10px);
     border: 1px solid #ffffff;
     padding: 20px;
     margin-top: 20px; /* Margin at the top before the card */
     transition: transform 0.3s ease;
     max-height: 400px; /* Set a max height for the card */
     overflow-y: auto; /* Enable vertical scrollbar when content exceeds the height */
   }
/*   .glass-card:hover {
    transform: scale(1.02);
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }*/


  .glass-card:hover {
  transform: scale(1.02);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  backdrop-filter: none; /* Remove the blur effect on hover */
}
  .playlist-title {
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
  }
  .playlist-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .playlist-list-item {
    padding: 10px 0;
    transition: background-color 0.3s ease;
  }
  .playlist-list-item a {
    text-decoration: none;
    color: #000000; /* Adjust text color for better visibility */
  }
  .playlist-list-item a:hover {
    color: #02999f;
  }
  .playlist-list-item:hover {
    background-color: #ffbd58;
  }
</style>
</head>
<body>
  <header>
    <img src="{{asset('logo.png')}}" alt="Logo"> <!-- Replace 'logo.png' with the path to your logo image -->
  </header>
  <div class="container mt-2" >
    <div class="row">
      <div class="col-md-6 offset-md-3">
       <h2 class="playlist-title">Choose a Playlist</h2>
       <div class="glass-card">
        <ul class="playlist-list">
          @yield('body')
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- <footer>
  <p>&copy; ZearDeveloper 2023</p>
</footer> -->
<!-- Bootstrap JS (if needed) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endif