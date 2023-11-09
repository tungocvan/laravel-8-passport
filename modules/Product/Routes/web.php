<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Product\Http\Controllers\ProductController;
 Route::middleware(['web','auth'])->prefix('/product')->name('product.')->group(function(){
     Route::get('/', [ProductController::class, 'index'])->name('index');
     Route::get('/add', [ProductController::class, 'add'])->name('add');     
     Route::post('/addProduct', [ProductController::class, 'productAdd'])->name('product-add');
     Route::get('/category', [ProductController::class, 'category'])->name('category');
     Route::post('/addCategory', [ProductController::class, 'productAddCategory'])->name('product-add-category');

     Route::post('/addCategory', [ProductController::class, 'productAddCategory'])->name('product-add-category');
     Route::get('/edit/{id}', [ProductController::class, 'productCategoryEdit'])->name('product-edit-category');
     Route::get('/delete/{id}', [ProductController::class, 'productCategoryDelete'])->name('product-delete-category');

     Route::get('/tags', [ProductController::class, 'tags'])->name('tags');
     Route::get('/attributes', [ProductController::class, 'attributes'])->name('attributes');
});

  