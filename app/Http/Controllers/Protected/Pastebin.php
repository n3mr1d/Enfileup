<?php

namespace App\Http\Controllers\Protected;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Pastebin as ModelPastebin;

class Pastebin extends Controller
{
    //show form password 
    public function index($uuid)
    {
        $pastebin = ModelPastebin::where('pastebin_id', $uuid)->first();
        if (!$pastebin) {
            abort(404, __('errors.pastebin.404'));
        }
        $sessionKey = "pastebin_{$pastebin->password}_{$pastebin->pastebin_id}";
        if (session()->get($sessionKey)) {
            return redirect()->route('pastebin.preview', ['uuid' => $uuid]);
        }
        return view('protected.index', compact('pastebin'));
    }
    public function pastebinstore(Request $request)
    {
        $validate = $request->validate([
            'uuid' => "required|exists:pastebins,pastebin_id",
            'password' => 'required',
        ]);
        $pastebin = ModelPastebin::where('pastebin_id', $validate['uuid'])->first();

        if (Hash::check($validate['password'], $pastebin->password)) {
            // Set session for password-protected pastebin
            $sessionKey = "pastebin_{$pastebin->password}_{$pastebin->pastebin_id}";
            session()->put($sessionKey, true);

            return redirect()->route('pastebin.preview', ['uuid' => $validate['uuid']]);
        }

        // Return with error bag so you can use @error('password') in Blade
        return redirect()->back()
            ->withErrors(['password' => 'Incorrect password.'])
            ->withInput();
    }
}
