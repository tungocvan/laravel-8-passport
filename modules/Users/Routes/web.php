<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Users\Http\Controllers\UsersController;
 Route::middleware(['web','users.middleware'])->prefix('/users')->name('users.')->group(function(){
     Route::get('/', [UsersController::class, 'index'])->name('index');
});

 