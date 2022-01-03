<?php

Route::namespace('Admin')->prefix('admin')->middleware(['auth:sanctum'])->group( function(){
    Route::apiResource('/categories', CategoryController::class);
});