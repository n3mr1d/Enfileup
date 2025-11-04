<?php

use App\Http\Controllers\CommentarUser;
use App\Http\Controllers\PastebinController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route for upload pastebin  file
Route::prefix('pastebin')->group(function () {
    Route::get('/', [PastebinController::class, 'index'])->name('pastebin.index');
    Route::post('/upload', [PastebinController::class, 'store'])->name('pastebin.store');

    //route download pastebin file
    Route::get('/download/{uuid}', [PastebinController::class, 'download'])->name('download.pastebin');
    // route preview pastebin file (raw)
    Route::get('/id/raw/{uuid}', [PastebinController::class, 'rawshow'])->name('raw.index');
    //route preview pastebin file (render html atau md)
    Route::get('/preview/fullpage/{uuid}', [PastebinController::class, 'fullpageShow'])->name('fullpage.pastebin');
    Route::get('/preview/{uuid}', [PastebinController::class, 'previewPastebin'])->name('pastebin.preview');
});

Route::prefix('commentar')->group(function () {
    //  commentar for pastebin
    Route::post('/post/pastebin', [CommentarUser::class, 'pastebinPost'])->name('pastebin.comment');
    //commentar for files
});

