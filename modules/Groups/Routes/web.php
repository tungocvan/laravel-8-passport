<?php 

 use Modules\Groups\Models\Groups;
 use Illuminate\Support\Facades\Route;
 use Modules\Groups\Http\Controllers\GroupsController;
 Route::middleware(['web','auth'])->prefix('/groups')->name('groups.')->group(function(){
     Route::get('/users', [GroupsController::class, 'index'])->name('index')->can('view',Groups::class);
     Route::get('/users/add', [GroupsController::class, 'add'])->name('add')->can('create',Groups::class);
     Route::post('/users/add', [GroupsController::class, 'postAdd'])->name('post-add')->can('create',Groups::class);
     Route::get('/users/permission/{group}', [GroupsController::class, 'permission'])->name('permission')->can('permission',Groups::class);
     Route::post('/permission/{group}', [GroupsController::class, 'postPermission'])->name('post-permission');
});

 