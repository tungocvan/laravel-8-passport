<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Groups\Http\Controllers\GroupsController;
 Route::middleware(['web','auth'])->prefix('/groups')->name('groups.')->group(function(){
     Route::get('/', [GroupsController::class, 'index'])->name('index');
     Route::get('/permission/{group}', [GroupsController::class, 'permission'])->name('permission');
});

 