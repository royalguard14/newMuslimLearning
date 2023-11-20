<?php
namespace App\Http\Controllers;
use App\Models\Videos;
use App\Models\VideoDetails;
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
      $videosLocal = Videos::where('type', 'local')
      ->select('id', 'video_name', 'video_path', 'created_at')
      ->get();
      $videosembed = Videos::where('type', 'embed')
      ->select('id', 'video_name', 'video_path', 'created_at')
      ->get();

      $youtubeSrc = [];
      $facebookSrc = [];
      foreach ($videosembed as $video) {
    // Extracting src from the video_path
        $html = $video->video_path;
        $pattern = '/<iframe[^>]+src="([^"]+)"/';
        preg_match($pattern, $html, $matches);
        if (isset($matches[1])) {
            $srcValue = $matches[1];
        // Identify if src is from Facebook or YouTube
            if (strpos($srcValue, 'youtube.com') !== false) {
            // For YouTube videos
                $youtubeSrc[] = [
                    'id' => $video->id,
                    'video_name' => $video->video_name,
                    'created_at' => $video->created_at,
                    'src' => 'https://www.youtube.com/embed/' . basename(parse_url($srcValue, PHP_URL_PATH)),
                ];
            } elseif (strpos($srcValue, 'facebook.com') !== false) {
            // For Facebook videos
                $facebookSrc[] = [
                    'id' => $video->id,
                    'video_name' => $video->video_name,
                    'created_at' => $video->created_at,
                    'src' => $srcValue,
                ];
            }
        }
    }
    return view('welcome',compact('videosLocal','facebookSrc','youtubeSrc'));
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


$randdom = Videos::select('id', 'video_name', 'video_path', 'created_at')
    ->inRandomOrder()
    ->limit(6)
    ->get();

$youtubeSrc = [];
$facebookSrc = [];
$localSrc = [];


$allvidrandom = [];

foreach ($randdom as $video) {
    $html = $video->video_path;
    $pattern = '/<iframe[^>]+src="([^"]+)"/';

    preg_match($pattern, $html, $matches);

    if (isset($matches[1])) {
        $srcValue = $matches[1];

        if (strpos($srcValue, 'youtube.com') !== false) {
            $allvidrandom[] = [
                'id' => $video->id,
                'type' => 'youtube',
                'video_name' => $video->video_name,
                'created_at' => $video->created_at,
                'src' => 'https://www.youtube.com/embed/' . basename(parse_url($srcValue, PHP_URL_PATH)),
            ];
        } elseif (strpos($srcValue, 'facebook.com') !== false) {
            $allvidrandom[] = [
                'id' => $video->id,
                'type' => 'facebook',
                'video_name' => $video->video_name,
                'created_at' => $video->created_at,
                'src' => $srcValue,
            ];
        }
    } else {
        // Handle videos without iframes
        $allvidrandom[] = [
            'id' => $video->id,
            'type' => 'local',
            'video_name' => $video->video_name,
            'created_at' => $video->created_at,
            'src' => $video->video_path, 
        ];
    }
}



























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
        // Identify if src is from Facebook or YouTube
            if (strpos($srcValue, 'youtube.com') !== false) {
            // For YouTube videos
                $playy[] = [
                    'type'  => 'youtube',
                    'pdf_note' => $playvid->pdf_note,
                    'description' => $playvid->description,
                    'video_name' => $playvid->video_name,
                    'created_at' => $playvid->created_at,
                    'src' => 'https://www.youtube.com/embed/' . basename(parse_url($srcValue, PHP_URL_PATH)),
                ];
            } elseif (strpos($srcValue, 'facebook.com') !== false) {
            // For Facebook videos
                $playy[] = [
                  'type'  => 'facebook',
                  'pdf_note' => $playvid->pdf_note,
                  'description' => $playvid->description,
                  'video_name' => $playvid->video_name,
                  'created_at' => $playvid->created_at,
                  'src' => $srcValue,
              ];
          }
      }
  }
//update views after click,
  $vidviews = VideoDetails::where('vidlib_id', $id)
  ->select('views')
  ->first();
  return view('steam', compact('playy','vidviews','id','allvidrandom'));
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