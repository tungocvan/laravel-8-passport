<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Users\Http\Controllers\api\UsersController;
 Route::middleware(['api'])->prefix('/api/users')->name('api.users.')->group(function(){
     Route::get('/', [UsersController::class, 'index'])->name('index');
});
 
  