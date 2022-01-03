<?php

Route::namespace('Guest')->group( function(){
    Route::apiResource('/categories', CategoryController::class);
});