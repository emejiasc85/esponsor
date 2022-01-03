<?php

Route::namespace('Guest')->group( function(){
    Route::get('/categories', CategoryController::class);
    Route::get('/products', ProductController::class);
});