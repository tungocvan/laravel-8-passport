<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Upload\Http\Controllers\api\UploadController;
 Route::middleware(['api'])->prefix('/api/upload')->name('api.upload.')->group(function(){
     Route::post('/', [UploadController::class, 'index'])->name('index');
});
 
  