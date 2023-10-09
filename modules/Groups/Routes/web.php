<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Groups\Http\Controllers\GroupsController;
 Route::middleware(['web','auth'])->prefix('/groups')->name('groups.')->group(function(){
     Route::get('/users', [GroupsController::class, 'index'])->name('index');
     Route::get('/users/permission/{group}', [GroupsController::class, 'permission'])->name('permission');
     Route::post('/permission/{group}', [GroupsController::class, 'postPermission'])->name('post-permission');
});

 