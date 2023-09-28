<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Sanctum\Http\Controllers\api\SanctumController;
 Route::middleware(['api'])->prefix('/api')->name('api.')->group(function(){
     Route::get('/createToken', [SanctumController::class, 'login'])->name('login');
     Route::get('/freshToken', [SanctumController::class, 'freshToken'])->name('fresh-token');
});
 Route::middleware(['api','auth:sanctum'])->prefix('/api')->name('api.')->group(function(){
     Route::get('/getUsers', [SanctumController::class, 'getUsers'])->name('get-users');
     Route::get('/deleteToken', [SanctumController::class, 'deleteToken'])->name('delete-token');
});
 
  

