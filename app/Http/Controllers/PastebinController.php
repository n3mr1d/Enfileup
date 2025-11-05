<?php

namespace App\Http\Controllers;

use Purifier;
use App\Enum\ExpireTime;
use App\Models\Pastebin;
use Highlight\Highlighter;
use App\Http\Action\PastebinInput;
use App\Http\Requests\PastebinForm;
use Illuminate\Support\Facades\Crypt;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelMarkdown\MarkdownRenderer;

class PastebinController extends Controller
{
    public function index()
    {
        $title = 'Pastebin';
        $expire = ExpireTime::cases();
        return view('pastebin.index', compact('title', 'expire'));
    }

    public function store(PastebinForm $request, PastebinInput $action)
    {
        $action->handle($request);

        return redirect()->back()->with('success', 'Pastebin Uploaded Success');
    }
    //raw content for pastebin dan html
    public function rawshow($uuid)
    {
        $pastebin = Pastebin::where('pastebin_id', $uuid)->first();


        // Count view
        $pastebin->incrementView();

        $title = $pastebin->title;
        $contentenc = Storage::disk('public')->get($pastebin->url_pastebin);
        $content = Crypt::decryptString($contentenc);

        // Return raw content with appropriate highlighting if needed
        $highlighted = null;
        if (!empty($pastebin->extension) && !empty($content)) {
            try {
                $hl = new Highlighter();
                $highlighted = $hl->highlight($pastebin->extension, $content);
            } catch (\Exception $e) {
                $highlighted = null;
            }
        }

        return view('pastebin.raw.preview', [
            'title' => $title,
            'highlighted' => $highlighted,
        ]);
    }
    public function download($uuid)
    {
        $pastebin = Pastebin::where('pastebin_id', $uuid)->first();

        $pastebin->incrementDownload();
        return Storage::disk('public')->download($pastebin->url_pastebin, 'EnfileUp-' . $pastebin->title . '.' . $pastebin->extension);
    }

    //show fullpage html and markdown
    public function fullpageShow($uuid)
    {
        // Get model pastebin from database
        $pastebin = Pastebin::where('pastebin_id', $uuid)->first();


        $contentenc = Storage::disk('public')->get($pastebin->url_pastebin);
        $content = Crypt::decryptString($contentenc);

        // Default markup if file is empty
        if (empty(trim($content))) {
            $html = '<em>Empty file</em>';
        } else {
            if ($pastebin->extension === 'html') {
                $cleanhtml = Purify::clean($content);
                $html = $cleanhtml;
            } else {
                $html = app(MarkdownRenderer::class)->toHtml($content);
            }
        }

        return view('pastebin.fullpage.preview', compact('html', 'pastebin'));
    }



    public function previewPastebin($uuid)
    {
        //get information pastebin uuid 
        $pastebin = Pastebin::where('pastebin_id', $uuid)->first();

        $contentenc = Storage::disk('public')->get($pastebin->url_pastebin);
        $content = Crypt::decryptString($contentenc);
        if (empty(trim($content))) {
            $html = '<em>Empty file</em>';
        } else {
            if ($pastebin->extension === 'html') {
                $cleanhtml = Purify::clean($content);
                $html = $cleanhtml;
            } else {
                $html = app(MarkdownRenderer::class)->toHtml($content);
            }
        }
        return view('pastebin.preview', compact('html', 'pastebin'));


    }
}
