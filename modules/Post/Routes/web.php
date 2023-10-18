<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Post\Http\Controllers\PostController;
 use Modules\Post\Models\Post;
 Route::middleware(['web','auth'])->prefix('/post')->name('post.')->group(function(){
     Route::get('/', [PostController::class, 'index'])->name('index')->can('view',Post::class);
     Route::get('/add', [PostController::class, 'add'])->name('add')->can('create',Post::class);
     Route::post('/add', [PostController::class, 'postAddCategory'])->name('post-add-category')->can('create',Post::class);
     Route::get('/edit/{id}', [PostController::class, 'postCategoryEdit'])->name('post-edit-category')->can('update',Post::class);
     Route::get('/delete/{id}', [PostController::class, 'postCategoryDelete'])->name('post-delete-category')->can('update',Post::class);
     Route::get('/category', [PostController::class, 'category'])->name('category');
     Route::get('/tags', [PostController::class, 'tags'])->name('tags');
});

 