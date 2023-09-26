<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Env\Http\Controllers\EnvController;
 Route::middleware(['web','env.middleware'])->prefix('/env')->name('env.')->group(function(){
     Route::get('/', [EnvController::class, 'index'])->name('index');     
     Route::post('/', [EnvController::class, 'postEnv'])->name('postEnv');     
});

 