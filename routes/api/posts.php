<?php
Route::prefix('cygnus')
    ->group(function(){
        Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index']);
        Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show']);
        Route::post('/posts',[\App\Http\Controllers\PostController::class, 'store']);
        Route::patch('/posts/{post}',[\App\Http\Controllers\PostController::class, 'patch']);
        Route::delete('/posts/{post}',[\App\Http\Controllers\PostController::class, 'destroy']);
    });
