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
<?php         
if ($vidviews) {
    $views = $vidviews->views ?? 0; 
    $views++; 
    VideoDetails::where('vidlib_id', $id)
    ->update(['views' => $views]);
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>YouTube</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontpanel/styles/reset.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/frontpanel/styles/main.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <style type="text/css">
       .video-container {
        display: flex;
        align-items: center;
    }
    .aside__video {
        padding-bottom: 0.3em;
        margin-right: 20px; /* Adjust margin as needed */
    }
    .video-details {
        display: flex;
        flex-direction: column;
    }
    .video-title {
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: .5rem;
        text-decoration: none;
        color: black;
    }
    .video-metadata {
        color: #555;
    }
</style>
</head>
<body>
    <div class="wrapper">
        <header>
<div class="header__logo">
    <a href="{{route('main.web')}}">
        <img src="{{ asset('assets/frontpanel/images/header/yt-logo.png') }}" alt="YouTube logo" class="header__yt-logo">
    </a>
</div>
            <div class="search">
                <form>
                    <input type="text" name="search" id="search__input" placeholder="Search">
                    <a href="#">
                        <img src="{{asset('assets/frontpanel/images/header/search.png')}}" alt="Search Icon" class="search__icon">
                    </a>
                </form>
            </div>
            <div class="header__icons header__logo">
            </div>
        </header>
        <div class="main-wrapper">
            <div class="left"></div>
            <main>
                <div class="main__video">
                    <div class="main__video-container">
                        @if ($playy[0]['type'] == 'local')
                        <video class="thumbnail-video" width="100%" height="450" controls>
                            <source src="{{asset('storage/uploads/' . $playy[0]['video_path'])}}" type="video/mp4">
                            </video>
                            @elseif ($playy[0]['type'] == 'facebook')
                            <iframe 
                            src="{{ $playy[0]['src'] }}" 
                            width="250" 
                            height="150" 
                            style="border:none;overflow:hidden" 
                            scrolling="no" 
                            frameborder="0" 
                            allowfullscreen="true" 
                            allow="autoplay; clipboard-write;  picture-in-picture; " 
                            allowFullScreen="true"></iframe>    
                            @else
                            <iframe 
                            width="250" 
                            height="150" 
                            src="{{ $playy[0]['src'] }}" 
                            frameborder="0" 
                            allowfullscreen></iframe>
                            @endif
                        </div>
                        <div class="main__description">
                            <p>{{ $playy[0]['video_name']}}</p>
                            <p>{{$vidviews['views']}} views</p>
                        <!--     <a href="#">
                                <img src="{{asset('assets/frontpanel/images/describe-icons.jpg')}}" alt="describe-icons" >
                            </a> -->
                        </div>
                        <div class="main__sub-description">
                            <a href="#">
                                <img class="main__name" src="{{asset('assets/frontpanel/images/describe-name.jpg')}}" alt="name">
                            </a>
                            @if(isset($playy[0]['pdf_note']))
                            <a id="downloadLink" href="{{asset('storage/uploads/' . $playy[0]['pdf_note'])}}" download style="display:none;"></a>
                            <img class="main__subscriptions" src="{{asset('assets/frontpanel/images/subscribed.png')}}" alt="subscriptions" onclick="downloadFile()">
                            @endif
                            <br>
                            <p>{{$playy[0]['description']}}</p>
                        </div>
                    </div>
                    <aside class="aside">
                        <div class="aside__top-container">
                            <p>Up next</p>
                            <!--   <a href="#">AUTOPLAY</a> -->
                        </div>
                        @foreach($allvidrandom as $ranvid)
                        <?php $reg = DB::table('video_details')->where('vidlib_id',$ranvid['id'])->first();?>  
                        @if($ranvid['type'] == 'local')
                        <div class="video-container">
                            <a class="aside__video" href="#">
                                <video class="thumbnail-video" width="155" height="100" controls>
                                    <source src="{{asset('storage/uploads/' . $ranvid['src'])}}" type="video/mp4">
                                    </video>
                                </a>
                                <div class="video-details">
                                   <a href="{{ route('stream.show', ['id' => $ranvid['id']]) }}" class="video-title">{{$ranvid['video_name'] }}</a>
                                   <!-- Other video details -->
                                   <div class="video-metadata">
                                    <span>Views: {{$reg->views}}</span>
                                    •
                                    <span>{{ $ranvid['created_at']->diffForHumans() }}</span> 
                                </div>
                            </div>
                        </div>
                        @elseif($ranvid['type'] == 'youtube')
                        <div class="video-container">
                            <a class="aside__video" href="#">
                             <iframe 
                             width="155" 
                             height="100" 
                             src="{{$ranvid['src']}}" 
                             frameborder="0" 
                             allowfullscreen></iframe>
                         </a>
                         <div class="video-details">
                             <a href="{{ route('stream.show', ['id' => $ranvid['id']]) }}" class="video-title">{{$ranvid['video_name'] }}</a>
                             <!-- Other video details -->
                             <div class="video-metadata">
                                <span>Views: {{$reg->views}}</span>
                                •
                                <span>{{ $ranvid['created_at']->diffForHumans() }}</span> 
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="video-container">
                        <a class="aside__video" href="#">
                            <iframe 
                            src="{{$ranvid['src']}}" 
                            width="155" 
                            height="100" 
                            style="border:none;overflow:hidden" 
                            scrolling="no" 
                            frameborder="0" 
                            allowfullscreen="true" 
                            allow="autoplay; clipboard-write;  picture-in-picture; " 
                            allowFullScreen="true"></iframe>
                        </a>
                        <div class="video-details">
                            <a href="{{ route('stream.show', ['id' => $ranvid['id']]) }}" class="video-title">{{$ranvid['video_name'] }}</a>
                            <!-- Other video details -->
                            <div class="video-metadata">
                                <span>Views: {{$reg->views}}</span>
                                •
                                <span>{{ $ranvid['created_at']->diffForHumans() }}</span>  
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    <div class="aside__more">
                      <a href="#">SHOW MORE</a>
                  </div>
              </aside>
                   <!--  <section>
                        <div>
                            <div class="section__comments">
                                <p>6,806 Comments</p>
                            </div>
                            <div class="section__sort-container">
                                <a href="#">
                                    <img src="{{asset('assets/frontpanel/images/sort.jpg')}}" alt="sort comments">
                                    <p>SORT BY</p>
                                </a>
                            </div>
                            <div class="section__profile">
                                <img src="{{asset('assets/frontpanel/images/profile_icon.png')}}" alt="profile_icon"> 
                            </div>
                            <div class="input__container">
                                <form>
                                    <input type="text" name="comment" id="comment" value="Add a public comment...">
                                </form>
                            </div>
                        </div>
                        <div>
                            <div class="comments">
                                <img src="{{asset('assets/frontpanel/images/profile_icon.png')}}" alt="profile icon" width="50">
                                <p class="comments__name">John Snow <a href="#">10 months ago</a> </p>
                                <p class="comments__comment">Stephen A will do anything he possibly can to get KD on the Knicks 😂.</p>
                                <div class="likes">
                                    <a href="#">
                                        <img src="{{asset('assets/frontpanel/images/like.jpg')}}" alt="like">
                                    </a>
                                    <p class="comments__text">1K</p>
                                    <a href="#">
                                        <img src="{{asset('assets/frontpanel/images/dislike.jpg')}}" alt="dislike">
                                    </a>
                                    <a href="#" class="comments__text">REPLY</a>
                                </div>
                                <a href="#" class="comments_replies">View all 7 replies</a>
                            </div>
                        </div>
                    </section> -->
                </main>
            </div>
        </div>
        <script type="text/javascript">
            function downloadFile() {
                var downloadLink = document.getElementById('downloadLink');
                downloadLink.click();
            }
        </script>
    </body>
    </html>
    @endif