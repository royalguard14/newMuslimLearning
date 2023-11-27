<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoChat;

class VideoChatController extends Controller
{
     public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'video_id' => 'required|exists:video_library,id',
            'user_id' => 'required|exists:users,id', // Assuming you have a User model
            'message' => 'required|string',
        ]);

        // Create a new chat message
        $chat = VideoChat::create([
            'video_id' => $validatedData['video_id'],
            'user_id' => $validatedData['user_id'],
            'message' => $validatedData['message'],
        ]);

        // Return a response
        return response()->json(['message' => 'Chat message created successfully', 'data' => $chat], 201);
    }
}
