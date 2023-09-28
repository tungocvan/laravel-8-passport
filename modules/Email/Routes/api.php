<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Email\Http\Controllers\api\EmailController;
 Route::middleware(['api'])->prefix('/api/email')->name('api.email.')->group(function(){
     Route::post('/', [EmailController::class, 'index'])->name('index'); 
});
 
  