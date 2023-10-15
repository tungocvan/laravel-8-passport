<?php 

use App\Models\User;

 use Modules\Users\Models\Users;
 use Illuminate\Support\Facades\Route;
 use Modules\Users\Http\Controllers\UsersController;
 Route::middleware(['web','auth'])->prefix('/users')->name('users.')->group(function(){
     Route::get('/', [UsersController::class, 'index'])->name('index')->can('view',Users::class);
     Route::get('/add', [UsersController::class, 'add'])->name('add')->can('create',Users::class);
     Route::post('/add', [UsersController::class, 'postAdd'])->name('post-add')->can('create',Users::class);
     Route::get('/edit/{user}', [UsersController::class, 'edit'])->name('edit')->can('update',Users::class);
     Route::post('/edit/{id}', [UsersController::class, 'postEdit'])->name('post-edit')->can('update',Users::class);
     Route::get('/delete/{id}', [UsersController::class, 'postDelete'])->name('delete')->can('delete',Users::class);
     Route::get('/profile', [UsersController::class, 'profile'])->name('profile');
     Route::get('/permission', [UsersController::class, 'permission'])->name('permission');     
});

 