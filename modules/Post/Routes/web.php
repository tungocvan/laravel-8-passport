<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Post\Http\Controllers\PostController;
 use Modules\Post\Models\Post;
 Route::middleware(['web','auth'])->prefix('/post')->name('post.')->group(function(){
     Route::get('/', [PostController::class, 'index'])->name('index')->can('viewAny',Post::class);
     Route::get('/add', [PostController::class, 'add'])->name('add');
     Route::get('/category', [PostController::class, 'category'])->name('category');
     Route::get('/tags', [PostController::class, 'tags'])->name('tags');
});

 