<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Category\Http\Controllers\CategoryController;
 use Modules\Category\Models\Category;
Route::middleware(['web','auth'])->prefix('/category')->name('category.')->group(function(){
    Route::get('/', [CategoryController::class, 'index'])->name('index')->can('view',Category::class);
    Route::get('/add', [CategoryController::class, 'add'])->name('add')->can('create',Category::class);
    Route::get('/edit/Category', [CategoryController::class, 'edit'])->name('edit')->can('update',Category::class);
    Route::post('/delete/{id}', [CategoryController::class, 'delete'])->name('delete')->can('delete',Category::class);     
});

 