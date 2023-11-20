<?php
namespace App\Http\Controllers;
use App\Models\Videos;
use App\Models\VideoDetails;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use DB;
use Auth;
class VideoController extends Controller
{
    

    public function index()
    {
        $videos = Videos::where('type', 'local')->get();
        return view('videos.index',compact('videos'));
    }
    

    public function create()
    {
        return view('videos.addvid');
    }
    

    public function show($id)
    {

        $videoLib = Videos::find($id);
        return response()->json([
            'status' => 200,
            'video' => $videoLib,
        ]);
    }
    

    public function store(Request $request)
    {
        $loged = Auth::user();
        $public_path = storage_path();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomu = substr(str_shuffle($permitted_chars), 0, 6);
        $pdf_path = null;
        if ($request->hasFile('pdfUpload')) {
            $pdf_name = $request->file('pdfUpload')->getClientOriginalName();
            $pdf_path = 'footnotes/' . $randomu . '/' . $pdf_name;
            $destinationPath = $public_path . '/app/public/uploads/footnotes/' . $randomu;
            $request->file('pdfUpload')->move($destinationPath, $pdf_name);
        }
        if ($request->hasFile('videoUpload')) {
            $video_name = $request->file('videoUpload')->getClientOriginalName();
            $video_path = 'videos/' . $randomu . '/' . $video_name;
            $destinationPath = $public_path . '/app/public/uploads/videos/' . $randomu;
            $request->file('videoUpload')->move($destinationPath, $video_name);
        }
        $videoLibrary = new Videos();
        $videoLibrary->video_name = $request->videoTitle;
        $videoLibrary->video_path = $video_path;
        $videoLibrary->description = $request->videoDescriptions;
        $videoLibrary->pdf_note = $pdf_path;
        $videoLibrary->type = "local";
        $videoLibrary->save();

        $lastInsertedId = $videoLibrary->id;
        $userId = auth()->id();
        $videoDetail = new VideoDetails();
        $videoDetail->vidlib_id = $lastInsertedId;
        $videoDetail->uploader = $userId;
        $videoDetail->save();
        return redirect()->route('video.index');
    }
    

    public function destroy(Request $request){
        $loged = Auth::id();
        DB::table('video_library')->where('id',$request->id)->delete();
        DB::table('video_details')->where('vidlib_id',$request->id)->delete();
        return back()->with('is_success','DELETED!');
    }

    public function update(Request $request){


    $video = Videos::find($request->id);

    if ($video) {
        $video->video_name = $request->videoTitle;
        $video->description = $request->videoDescription;
        $video->save();

        return response()->json(['message' => 'Video details updated successfully']);
    }

    return response()->json(['message' => 'Video not found'], 404);
    }




  


}