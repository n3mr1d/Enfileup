<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Pastebin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordPastebin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uuid = $request->route('uuid');
        $pastebin = Pastebin::where('pastebin_id', $uuid)->first();

        if (!$pastebin || !Storage::disk('public')->exists($pastebin->url_pastebin)) {
            abort(404, __('errors.pastebin.404'));
        }

        if ($pastebin->needPassword()) {
            $sessionKey = "pastebin_{$pastebin->password}_{$pastebin->pastebin_id}";
            if (!session()->get($sessionKey)) {
                return redirect()->route('protected.pastebin', ['uuid' => $uuid]);
            }
        }

        return $next($request);
    }
}
