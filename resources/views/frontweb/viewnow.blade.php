@extends('layouts.frontweb')
@section('body')
<?php 
use App\Models\Videos
?>
<script type="text/javascript">
  window.onload = function() {
   $(".main-container").addClass("show");
   $(".main-container").scrollTop(0);
   $(".sidebar-link").removeClass("is-active");
   $(".{{$playy[0]['type']}}").addClass("is-active");
 };
</script>
<div class="stream-area">
  <div class="video-stream">
   @if ($playy[0]['type'] == 'local')
   <video id="my_video_1" class="video-js vjs-default-skin anim"  controls preload="none" style="width: 640px; height: 267px">
    <source src="{{asset('storage/uploads/' . $playy[0]['video_path'])}}" type="video/mp4">
    </video>
    @elseif ($playy[0]['type'] == 'facebook')
    <div class="fb-video" data-href="{{ $playy[0]['src'] }} "  
    data-allowfullscreen="true" data-width="650"></div>
    @else
    <iframe 
    width="650" 
    height="267" 
    src="{{ $playy[0]['src'] }}" 
    frameborder="0" 
    fullscreen="true" 
    allowfullscreen></iframe>
    @endif
    <div class="video-detail">
      <div class="video-content">
       <div class="video-p-wrapper anim" style="--delay: .1s">
        <div class="author-img__wrapper video-author video-p">
     
       
      </div>
      <div class="video-p-detail">
 <div class="video-p-title anim" style="--delay: .2s">{{$playy[0]['video_name']}}</div>
     </div>

@if(isset($playy[0]['pdf_note']))
    @if(strpos($playy[0]['pdf_note'], 'blank.pdf') !== false)
    
    @else
        <div class="button-wrapper">
            <a id="downloadLink" href="{{ asset('storage/uploads/' . $playy[0]['pdf_note']) }}" download style="display:none;"></a>
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

<?php 
$string = $playy[0]['description'];
$paragraphs = explode("\n\n", $string);
$secs = 1;
foreach ($paragraphs as $index => $paragraph) {
    $secs++; // Increment the seconds
    echo '<div class="video-p-subtitle anim" style="--delay: ' . $secs . 's">' . $paragraph . '</div>';
  }
  ?>
</div>
</div>
</div>
<div class="chat-stream">
  <!-- start -->
  <div class="chat-v id__container">
    <div class="chat-vid__title anim" style="--delay: .1s">Related Videos</div>
    <?php $x = 1; ?>
    @foreach($randdom as $ranvids)
    <?php $x++ ?>
    <div class="chat-vid anim" style="--delay: .<?php echo $x ?>s"    onclick="window.location.href = '{{ route('stream.show', ['id' => $ranvids->id]) }}'">
     <div class="chat-vid__wrapper">
    
      <div class="chat-vid__content">
       <div class="chat-vid__name" onclick="window.location.href = '{{ route('stream.show', ['id' => $ranvids->id]) }}'" > • {{$ranvids->video_name}}</div>
       <!--  <div class="chat-vid__by">Jordan Wise</div> -->
 
     </div>
   </div>
 </div>
 @endforeach
 <div class="chat-vid__button anim" style="--delay: .<?php echo $x+1 ?>s" onclick="window.location.href ='{{route('web.playlist')}}'">See All videos ({{Videos::count()}})</div>
</div><!-- end -->
</div>
</div>
        <script type="text/javascript">
            function downloadFile() {
                var downloadLink = document.getElementById('downloadLink');
                downloadLink.click();
            }
        </script>
@endsection