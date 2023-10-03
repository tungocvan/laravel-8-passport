<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Product\Http\Controllers\ProductController;
 Route::middleware(['web','auth'])->prefix('/product')->name('product.')->group(function(){
     Route::get('/', [ProductController::class, 'index'])->name('index');
     Route::get('/add', [ProductController::class, 'add'])->name('add');
     Route::get('/category', [ProductController::class, 'category'])->name('category');
     Route::get('/tags', [ProductController::class, 'tags'])->name('tags');
     Route::get('/attributes', [ProductController::class, 'attributes'])->name('attributes');
});

 