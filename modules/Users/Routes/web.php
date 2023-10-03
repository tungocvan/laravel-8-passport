<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Users\Http\Controllers\UsersController;
 Route::middleware(['web','auth'])->prefix('/users')->name('users.')->group(function(){
     Route::get('/', [UsersController::class, 'index'])->name('index');
     Route::get('/add', [UsersController::class, 'add'])->name('add');
     Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
     Route::get('/permission', [UsersController::class, 'permission'])->name('permission');
});

 