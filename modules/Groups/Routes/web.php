<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Groups\Http\Controllers\GroupsController;
 Route::middleware(['web','groups.middleware'])->prefix('/groups')->name('groups.')->group(function(){
     Route::get('/', [GroupsController::class, 'index'])->name('index');
});

 