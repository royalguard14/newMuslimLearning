<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Videos;
use DB;


class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $playlists = Playlist::all();
    $videos = Videos::all();
    
    return view('playlist.index', compact('playlists', 'videos'));
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


    $request->validate([
        'playlist_name' => 'required|unique:playlists,name|max:255',
    ]);

    $playlist = Playlist::create(['name' => $request->playlist_name]);

    
        if ($request->has('video_ids')) {
            $videos = $request->video_ids;

        
            foreach ($videos as $videoId) {
                DB::table('playlist_video')->insert([
                    'playlist_id' => $playlist->id,
                    'video_id' => $videoId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }



    $playlists = Playlist::all();
    $videos = Videos::all();
    
    return view('playlist.index', compact('playlists', 'videos'));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // dd($id);
        try {
            $playlist = Playlist::findOrFail($id);
            $videos = $playlist->videos; // Assuming 'videos' is the relationship in Playlist model

            return response()->json(['videos' => $videos]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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


public function addVideoToPlaylist(Request $request, $playlistId)
{
    try {
        $playlist = Playlist::findOrFail($playlistId);

        // Assuming the video_id is passed in the request
        $videoId = $request->input('video_id');
        $video = Video::findOrFail($videoId);

        // Attach the video to the playlist
        $playlist->videos()->attach($videoId);

        return response()->json(['message' => 'Video added to the playlist successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



public function deleteVideoFromPlaylist(Request $request, $playlistId)
{
    try {
        $playlist = Playlist::findOrFail($playlistId);

        // Assuming the video_id is passed in the request
        $videoId = $request->input('video_id');
        $video = Video::findOrFail($videoId);

        // Detach the video from the playlist
        $playlist->videos()->detach($videoId);

        return response()->json(['message' => 'Video removed from the playlist successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}









}
