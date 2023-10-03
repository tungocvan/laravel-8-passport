<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Admin\Http\Controllers\AdminController;
 Route::middleware(['web','auth'])->prefix('/admin')->name('admin.')->group(function(){
     Route::get('/', [AdminController::class, 'index'])->name('index');
});

 