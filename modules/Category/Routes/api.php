<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Category\Http\Controllers\api\CategoryController;
 Route::middleware(['api'])->prefix('/api/category')->name('api.category.')->group(function(){
     Route::get('/', [CategoryController::class, 'index'])->name('index');
});
 
  