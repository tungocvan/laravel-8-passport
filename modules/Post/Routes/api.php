<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Post\Http\Controllers\api\PostController;
 Route::middleware(['api'])->prefix('/api/post')->name('api.post.')->group(function(){
     Route::get('/', [PostController::class, 'index'])->name('index');
});
 
  