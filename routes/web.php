<?php

use App\Http\Controllers\CommentarUser;
use App\Http\Controllers\PastebinController;
use App\Http\Controllers\Protected\Pastebin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route for upload pastebin  file
Route::prefix('pastebin')->group(function () {
    Route::get('/', [PastebinController::class, 'index'])->name('pastebin.index');
    Route::post('/upload', [PastebinController::class, 'store'])->name('pastebin.store');
    Route::middleware('protectedpastebin.check')->group(function () {
        //route download pastebin file

        Route::get('/download/{uuid}', [PastebinController::class, 'download'])->name('download.pastebin');
        // route preview pastebin file (raw)
        Route::get('/id/raw/{uuid}', [PastebinController::class, 'rawshow'])->name('raw.index');
        //route preview pastebin file (render html atau md)
        Route::get('/preview/fullpage/{uuid}', [PastebinController::class, 'fullpageShow'])->name('fullpage.pastebin');
        Route::get('/preview/{uuid}', [PastebinController::class, 'previewPastebin'])->name('pastebin.preview');
    });

});

//route for password validation
//pastebin
Route::get('/pastebin/password/{uuid}', [Pastebin::class, 'index'])->name('protected.pastebin');
Route::post('/pastebin/check', [Pastebin::class, 'pastebinstore'])->name('validate.pastebin.protected');

Route::prefix('commentar')->group(function () {

    //get comment for pastebin 
    Route::get('/get/view/pastebin/{uuid}', [CommentarUser::class, 'pastebinindex'])->name('view.comment.pastebin');
    //get controller comment
    Route::get('/get/pastebin/controller/{uuid}', [CommentarUser::class, 'controllerpastebin'])->name('controller.pastebin');
    //  commentar for pastebin
    Route::post('/post/pastebin', [CommentarUser::class, 'pastebinPost'])->name('pastebin.comment');
    //commentar for files

});

