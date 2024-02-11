<!DOCTYPE html>
<html lang="en">
<head>
  <title>New Muslim Library</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="{{asset('vid_assest/button_style.css')}}">
  <style type="text/css">
   body {
    background-color: #363636;
    color: #ffffff;
    font-family: Arial, sans-serif;
    padding-bottom: 30px; 
  }
  p.no-margin {
    margin: 0;
  }
  .text-right {
    direction: rtl; /* Set text direction to right-to-left */
    text-align: right; /* Align text to the right */
  }
  .button-wrapper {
    display: flex;
    align-items: center;
    margin-left: auto;
  }
  .like {
   display: flex;
   align-items: center;
   background-color: var(--button-bg);
   color: black;
   border: 0;
   font-family: var(--body-font);
   border-radius: 8px;
   padding: 10px 16px;
   font-size: 14px;
   cursor: pointer;
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
.video-wrapper {
  position: relative;
  width: 100%;
  padding-bottom: 56.25%; /* 16:9 aspect ratio (9 / 16 * 100) */
}
.video-wrapper iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>
</head>
<body>
  <header>
    <img src="{{asset('logo.png')}}" alt="Logo"> <!-- Replace 'logo.png' with the path to your logo image -->
  </header>
  <div id="fb-root"></div>
  <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
  <p>{{ $playy[0]['src'] }}</p>
  <div class="container" style="margin-top: 10px; margin-bottom: 10px">
   <?php
   if(strpos($playy[0]['src'], 'youtube.com') !== false || strpos($playy[0]['src'], 'youtu.be') !== false) {
    ?>
    <div class="video-wrapper">
      <iframe 
      <?php 
      $src = $playy[0]['src'];
  // Check if $src contains "watch?v="
      if (strpos($src, 'watch?v=') !== false) {
    // Replace "watch?v=" with "embed/"
        $src = str_replace('watch?v=', 'embed/', $src);
      }
      ?>
      src="{{ $src }}" 
      style="border:none;overflow:hidden; width: 100%; height: 100%;" 
      frameborder="0" 
      allowfullscreen="true" 
      allow="autoplay; clipboard-write;  picture-in-picture; " 
      allowFullScreen="true">
    </iframe>
  </div>
  <?php
} else {
  ?>
  <div class="embed-responsive embed-responsive-16by9">
    <div class="fb-video" data-href="{{ $playy[0]['src'] }}" data-allowfullscreen="true"></div>
  </div>
  <?php
}
?>
<div class="row">
  <div class="col-md-10">
    <h2>{{$playy[0]['video_name']}}</h2>
  </div>
  <div class="col-md-2 text-right" >
    @if(isset($playy[0]['pdf_note']))
    @if(strpos($playy[0]['pdf_note'], 'blank.pdf') !== false)
    @else
    <?php 
    $filePath = $playy[0]['pdf_note'];
    $removeString = '/app/public/uploads';
    $cleanedPath = str_replace($removeString, '', $filePath);
    ?>
    <a id="downloadLink" href="{{ asset('storage/uploads'. $cleanedPath) }}" download style="display:none;"></a>
    <button class="custom-btn btn-7" onclick="downloadFile()"><span>Download PDF</span></button>
    @endif
    @endif
  </div>
</div>
<?php 
$string = $playy[0]['description'];
$paragraphs = explode("\n", $string);
foreach ($paragraphs as $index => $paragraph) {
    // Check if the paragraph contains a URL
  if (preg_match_all('/\b(?:https?|ftp):\/\/\S+\b/', $paragraph, $matches)) {
        // If URLs are found, replace them with clickable links
    foreach ($matches[0] as $url) {
      $paragraph = str_replace($url, '<a href="' . $url . '" target="_blank">' . $url . '</a>', $paragraph);
    }
  }
  $isArabic = preg_match('/\p{Arabic}/u', $paragraph);
  $class = $isArabic ? 'text-right' : 'no-margin'; 
  echo '<p class="' . $class . '">' . $paragraph . '</p>';
}
?>
</div>
<script type="text/javascript">
  function downloadFile() {
    var downloadLink = document.getElementById('downloadLink');
    downloadLink.click();
  }
</script>
<!--   <footer>
  <p>&copy; ZearDeveloper 2023</p>
</footer> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>