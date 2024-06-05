<?php
Route::prefix('cygnus')
    ->group(function(){
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
        Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show']);
        Route::post('/users',[\App\Http\Controllers\UserController::class, 'store']);
        Route::patch('/users/{user}',[\App\Http\Controllers\UserController::class, 'update']);
        Route::delete('/users/{user}',[\App\Http\Controllers\UserController::class, 'destroy']);
    });


