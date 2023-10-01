<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Product\Http\Controllers\ProductController;
 Route::middleware(['web','product.middleware'])->prefix('/product')->name('product.')->group(function(){
     Route::get('/', [ProductController::class, 'index'])->name('index');
});

 