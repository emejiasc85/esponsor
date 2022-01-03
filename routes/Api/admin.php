<?php


Route::namespace('Admin')->prefix('admin')->middleware(['auth:sanctum'])->group( function(){
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/products', ProductController::class);
    Route::apiResource('/carts', CartController::class);
});