<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Product\Http\Controllers\api\ProductController;
 Route::middleware(['api'])->prefix('/api/product')->name('api.product.')->group(function(){
     Route::get('/', [ProductController::class, 'index'])->name('index');
});
 
  