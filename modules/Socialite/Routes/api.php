<?php 
 use Illuminate\Support\Facades\Route;
 use Illuminate\Http\Request;
 use Modules\Socialite\Http\Controllers\api\SocialiteController;
 Route::middleware(['api'])->prefix('/api')->name('api.')->group(function(){
     Route::get('/socialite', [SocialiteController::class, 'index'])->name('index');  
     Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });   
});
 
  