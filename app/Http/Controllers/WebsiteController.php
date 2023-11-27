<?php
namespace App\Http\Controllers;
use App\Models\Videos;
use App\Models\VideoDetails;
use App\Models\VideoChat;
use Illuminate\Http\Request;
use DB;
class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//all video base on views
      $videos = Videos::join('video_details', 'video_library.id', '=', 'video_details.vidlib_id')
      ->select('video_library.id', 'video_library.video_name', 'video_library.video_path', 'video_library.created_at', 'video_details.views','video_library.type')
      ->orderBy('video_details.views', 'desc')
      ->take(5)
      ->get();
      $video_salang = [];
      foreach ($videos as $video) {
        if ($video -> type == "local") {
         $video_salang[] = [
          'id' => $video->id,
          'type' => 'local',
          'video_name' => $video->video_name,
          'created_at' => $video->created_at,
          'video_path' => $video->video_path, 
          'views' => $video->views
        ];
      }else{
        $html = $video->video_path;
        $pattern = '/<iframe[^>]+src="([^"]+)"/';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
          $srcValue = $matches[1];
          $video_salang[] = [
            'id' => $video->id,
            'type' => 'youtube',
            'video_name' => $video->video_name,
            'created_at' => $video->created_at,
            'video_path' => 'https://www.youtube.com/embed/' . basename(parse_url($srcValue, PHP_URL_PATH)),
            'views' => $video->views
          ];
        }else{
          $video_salang[] = [
            'id' => $video->id,
            'type' => 'facebook',
            'video_name' => $video->video_name,
            'created_at' => $video->created_at,
            'video_path' => $html,
            'views' => $video->views
          ];
        }
      }
    }
    return view('frontweb.index',compact('video_salang'));
  }
  public function local(){
   $videos = Videos::join('video_details', 'video_library.id', '=', 'video_details.vidlib_id')
   ->select('video_library.id', 'video_library.video_name', 'video_library.video_path', 'video_library.created_at', 'video_details.views')
   ->where('video_library.type', '=', 'local')
   ->get();
   return view('frontweb.local',compact('videos'));
 }
 public function facebook(){
//all video base on views
  $videos = Videos::join('video_details', 'video_library.id', '=', 'video_details.vidlib_id')
  ->select('video_library.id', 'video_library.video_name', 'video_library.video_path', 'video_library.created_at', 'video_details.views')
  ->where('video_library.type', '=', 'embed')
  ->get();
  $video_salang = [];
  foreach ($videos as $video) {
    $html = $video->video_path;
    $srcValue = '';
    $pattern = '/<iframe[^>]+src="([^"]+)"/';
    preg_match($pattern, $html, $matches);
    if (!isset($matches[1])) {
      $video_salang[] = [
        'id' => $video->id,
        'video_name' => $video->video_name,
        'created_at' => $video->created_at,
        'video_path' => $video->video_path,
        'views' => $video->views
      ];
    }
  }
  return view('frontweb.facebook',compact('video_salang'));
}
public function youtube(){
//all video base on views
  $videos = Videos::join('video_details', 'video_library.id', '=', 'video_details.vidlib_id')
  ->select('video_library.id', 'video_library.video_name', 'video_library.video_path', 'video_library.created_at', 'video_details.views')
  ->where('video_library.type', '=', 'embed')
  ->get();
  $video_salang = [];
  foreach ($videos as $video) {
    $html = $video->video_path;
    $srcValue = '';
    $pattern = '/<iframe[^>]+src="([^"]+)"/';
    preg_match($pattern, $html, $matches);
    if (isset($matches[1])) {
      $srcValue = $matches[1];
      if (strpos($srcValue, 'youtube.com') !== false || strpos($srcValue, 'youtu.be') !== false) {
        $video_salang[] = [
          'id' => $video->id,
          'video_name' => $video->video_name,
          'created_at' => $video->created_at,
          'video_path' => $srcValue,
          'views' => $video->views
        ];
      }
    }
  }
  return view('frontweb.youtube',compact('video_salang'));
}
public function library(){
//all video base on views
  $videos = Videos::join('video_details', 'video_library.id', '=', 'video_details.vidlib_id')
  ->select('video_library.id', 'video_library.video_name', 'video_library.video_path', 'video_library.created_at', 'video_details.views','video_library.type')
  ->orderBy('video_details.views', 'desc')
  ->get();

 $video_salang = [];
      foreach ($videos as $video) {
        $html = $video->video_path;
        $pattern = '/<iframe[^>]+src="([^"]+)"/';

        if ($video->type == "local") {
         $video_salang[] = [
          'id' => $video->id,
          'type' => 'local',
          'video_name' => $video->video_name,
          'created_at' => $video->created_at,
          'video_path' => $video->video_path, 
          'views' => $video->views
        ];
      }else{
 
      
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
          $srcValue = $matches[1];
          $video_salang[] = [
            'id' => $video->id,
            'type' => 'youtube',
            'video_name' => $video->video_name,
            'created_at' => $video->created_at,
            'video_path' => 'https://www.youtube.com/embed/' . basename(parse_url($srcValue, PHP_URL_PATH)),
            'views' => $video->views
          ];
        }else{
          $video_salang[] = [
            'id' => $video->id,
            'type' => 'facebook',
            'video_name' => $video->video_name,
            'created_at' => $video->created_at,
            'video_path' => $html,
            'views' => $video->views
          ];
        }
      }
    }


    return view('frontweb.library',compact('video_salang'));
  }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
 

$randdom =Videos::join('video_details', 'video_library.id', '=', 'video_details.vidlib_id')
      ->select('video_library.id', 'video_library.video_name', 'video_library.created_at', 'video_details.views')
      ->inRandomOrder()
      ->limit(5)
      ->get();



    $playy = [];
        //to play,
    $playvid = Videos::where('id', $id)
    ->select('id','type', 'video_name', 'video_path','description', 'created_at','pdf_note')
    ->first();
    if ($playvid->type == "local") {
     $playy[] = [
      'type'  => 'local',
      'pdf_note' => $playvid->pdf_note,
      'description' => $playvid->description,
      'video_name' => $playvid->video_name,
      'created_at' => $playvid->created_at,
      'video_path' => $playvid->video_path,
    ];
  }else{
    $html = $playvid->video_path;
    $pattern = '/<iframe[^>]+src="([^"]+)"/';
    preg_match($pattern, $html, $matches);
    if (isset($matches[1])) {
      $srcValue = $matches[1];
      $playy[] = [
        'type'  => 'youtube',
        'pdf_note' => $playvid->pdf_note,
        'description' => $playvid->description,
        'video_name' => $playvid->video_name,
        'created_at' => $playvid->created_at,
        'src' => 'https://www.youtube.com/embed/' . basename(parse_url($srcValue, PHP_URL_PATH)),
      ];
    }else{
      $playy[] = [
        'type'  => 'facebook',
        'pdf_note' => $playvid->pdf_note,
        'description' => $playvid->description,
        'video_name' => $playvid->video_name,
        'created_at' => $playvid->created_at,
        'src' => $playvid->video_path,
      ];
    }
  }
//update views after click,
  $vidviews = VideoDetails::where('vidlib_id', $id)
  ->select('views')
  ->first();
  /*dd($playy);*/



$videoChats = VideoChat::where('video_id', $id)->get();


  return view('frontweb.viewnow', compact('playy','vidviews','id','randdom','videoChats'));
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  }