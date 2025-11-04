<?php

namespace App\Http\Controllers;

use App\Models\Pastebin;
use App\Models\CommentAnon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CommentarUser extends Controller
{
    public function pastebinPost(Request $request)
    {
        //validate input 
        $validated = $request->validate([
            'msg' => 'required|string|min:4|max:255',
            'uuid' => 'required|exists:pastebins,pastebin_id',
        ]);

        //cek pastebin in the database
        $pastebin = Pastebin::where('pastebin_id', $validated['uuid'])->firstOrFail();
        $username = 'Anonym-' . Str::random(10);

        $comment = new CommentAnon([
            'username' => $username,
            'content' => $validated['msg'],
            'commentable_type' => 'App\Models\Pastebin',
            'commentable_id' => $pastebin->id,
        ]);
        $pastebin->commentAnons()->save($comment);

        return redirect()
            ->back()
            ->with('success', 'Comment submitted successfully.');
    }
    public function index()
    {

    }
}
