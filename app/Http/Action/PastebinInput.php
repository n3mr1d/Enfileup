<?php

namespace App\Http\Action;

use App\Enum\ExpireTime;
use App\Models\Pastebin;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PastebinInput
{
    /**
     * Create a new class instance.
     */
    public function handle($request)
    {

        if ($request->validated()) {
            // Generate file
            $title = 'pastebin_' . Str::random(10);
            $password = $request->password ?? null;
            $expire = ExpireTime::from($request->expire_at)->getTime();
            $pastebin_id = (string) Str::uuid();
            $content = $request->content;
            $extension = $request->support;
            // store file to server 
            $filePath = 'pastebin/' . $title . '.txt';
            Storage::disk('public')->put($filePath, $content);

            // Simpan data ke database
            Pastebin::create([
                'title' => $title,
                'pastebin_id' => $pastebin_id,
                'url_pastebin' => $filePath,
                'password' => $password,
                'expire_at' => $expire,
                'extension' => $extension,
                'view' => 1,
                'download' => 0,
            ]);
        }
    }


}
