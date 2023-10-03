<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Admin\Http\Controllers\api\AdminController;
 Route::middleware(['api'])->prefix('/api/admin')->name('api.admin.')->group(function(){
     Route::get('/', [AdminController::class, 'index'])->name('index');
});
 
  