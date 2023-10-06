<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Groups\Http\Controllers\api\GroupsController;
 Route::middleware(['api'])->prefix('/api/groups')->name('api.groups.')->group(function(){
     Route::get('/', [GroupsController::class, 'index'])->name('index');
});
 
  