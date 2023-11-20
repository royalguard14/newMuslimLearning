<?php

namespace App\Http\Controllers;
use App\Models\Videos;
use App\Models\VideoDetails;
use Illuminate\Http\Request;
use DB;
use Auth;
class VideoeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Videos::where('type', 'embed')->get();
        return view('videoe.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('videoe.addvid');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $loged = Auth::user();
        $public_path = storage_path();
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomu = substr(str_shuffle($permitted_chars), 0, 6);
        $pdf_path = null;
        if ($request->hasFile('pdfUpload')) {
            $pdf_name = $request->file('pdfUpload')->getClientOriginalName();
            $pdf_path = '/app/public/uploads/footnotes/' . $randomu . '/' . $pdf_name;
            $destinationPath = $public_path . '/app/public//uploads/footnotes/' . $randomu;
            $request->file('pdfUpload')->move($destinationPath, $pdf_name);
        }

        $videoLibrary = new Videos();
        $videoLibrary->video_name = $request->videoTitle;
        $videoLibrary->video_path = $request->eLink;
        $videoLibrary->description = $request->videoDescriptions;
        $videoLibrary->pdf_note = $pdf_path;
        $videoLibrary->type = "embed";
        $videoLibrary->save();

        $lastInsertedId = $videoLibrary->id;
        $userId = auth()->id();
        $videoDetail = new VideoDetails();
        $videoDetail->vidlib_id = $lastInsertedId;
        $videoDetail->uploader = $userId;
        $videoDetail->save();
        return redirect()->route('videoe.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
                $videoLib = Videos::find($id);
        return response()->json([
            'status' => 200,
            'video' => $videoLib,
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    $video = Videos::find($request->id);

    if ($video) {
        $video->video_name = $request->videoTitle;
        $video->description = $request->videoDescription;
        $video->video_path = $request->video_path;
        $video->save();

        return response()->json(['message' => 'Video details updated successfully']);
    }

    return response()->json(['message' => 'Video not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $loged = Auth::id();
        DB::table('video_library')->where('id',$request->id)->delete();
        DB::table('video_details')->where('vidlib_id',$request->id)->delete();
        return back()->with('is_success','DELETED!');
    }
}
