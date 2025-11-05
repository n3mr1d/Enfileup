<?php

namespace App\Http\Controllers;

use App\Models\Pastebin;
use App\Models\CommentAnon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
        // Generate and store a new anonym username if not already present in session
        if (!session()->has('username')) {
            $username = 'Anon-' . Str::random(8);
            session(['username' => $username]);
        } else {
            $username = session('username');
        }

        // Save the comment
        CommentAnon::create([
            'username' => $username,
            'content' => $validated['msg'],
            'commentable_type' => Pastebin::class,
            'commentable_id' => $pastebin->id,
        ]);


        return redirect()
            ->back()
            ->with('success', 'Comment submitted successfully.');
    }
    public function controllerpastebin($uuid)
    {
        $pastebin = Pastebin::where('pastebin_id', $uuid)->first();
        $uuid = $pastebin->pastebin_id;

        return view('comment.form', compact('uuid'));
    }
    public function pastebinindex($uuid)
    {
        $pastebin = Pastebin::where('pastebin_id', $uuid)->first();
        $comment = $pastebin->commentuser()->paginate(5)->fragment('comment');
        return view('comment.view', compact('comment'));
    }
}
