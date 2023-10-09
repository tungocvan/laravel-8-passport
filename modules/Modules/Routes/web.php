<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Modules\Http\Controllers\ModulesController;
 Route::middleware(['web','auth'])->prefix('/modules')->name('modules.')->group(function(){
     Route::get('/users', [ModulesController::class, 'index'])->name('index');
     Route::get('/users/add', [ModulesController::class, 'add'])->name('add');
     Route::post('/store', [ModulesController::class, 'store'])->name('post-add');
     Route::get('/delete/{id}', [ModulesController::class, 'postDelete'])->name('post-delete');
     Route::get('/edit/{module}', [ModulesController::class, 'edit'])->name('edit');
     Route::post('/edit/{module}', [ModulesController::class, 'postEdit'])->name('post-edit');
});

 