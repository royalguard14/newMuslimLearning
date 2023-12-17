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
 </style>
</head>
<body>
    <header>
    <img src="{{asset('logo.png')}}" alt="Logo"> <!-- Replace 'logo.png' with the path to your logo image -->
  </header>
  <div id="fb-root"></div>
  <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
  <div class="container" style="margin-top: 10px; margin-bottom: 10px">
    <div class="embed-responsive embed-responsive-16by9">
      <div class="fb-video" data-href="{{ $playy[0]['src'] }}" data-allowfullscreen="true"></div>
    </div>
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
        <div class="button-wrapper">
          <a id="downloadLink" href="{{ asset('storage/uploads'. $cleanedPath) }}" download style="display:none;"></a>
          <button class="like" onclick="downloadFile()">
            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M21.435 2.582a1.933 1.933 0 00-1.93-.503L3.408 6.759a1.92 1.92 0 00-1.384 1.522c-.142.75.355 1.704 1.003 2.102l5.033 3.094a1.304 1.304 0 001.61-.194l5.763-5.799a.734.734 0 011.06 0c.29.292.29.765 0 1.067l-5.773 5.8c-.428.43-.508 1.1-.193 1.62l3.075 5.083c.36.604.98.946 1.66.946.08 0 .17 0 .251-.01.78-.1 1.4-.634 1.63-1.39l4.773-16.075c.21-.685.02-1.43-.48-1.943z" />
            </svg>
            Download PDF
          </button>
        </div>
        @endif
        @endif
      </div>
    </div>
    <?php 
    $string = $playy[0]['description'];
    $paragraphs = explode("\n", $string);
    foreach ($paragraphs as $index => $paragraph) {
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