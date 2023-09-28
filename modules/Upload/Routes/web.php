<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Upload\Http\Controllers\UploadController;
 Route::middleware(['web','upload.middleware'])->prefix('/upload')->name('upload.')->group(function(){
     Route::get('/', [UploadController::class, 'index'])->name('index');
});

 