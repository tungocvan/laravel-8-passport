<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Env\Http\Controllers\api\EnvController;
 Route::middleware(['api'])->prefix('/api/env')->name('api.env.')->group(function(){
     Route::get('/', [EnvController::class, 'index'])->name('index');
});
 
  