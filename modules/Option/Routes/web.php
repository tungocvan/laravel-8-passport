<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Option\Http\Controllers\OptionController;
 use Modules\Option\Models\Option;
Route::middleware(['web','auth','option.middleware'])->prefix('/option')->name('option.')->group(function(){
    Route::get('/', [OptionController::class, 'index'])->name('index')->can('view',Option::class);
    Route::get('/add', [OptionController::class, 'add'])->name('add')->can('create',Option::class);
    Route::get('/edit/Option', [OptionController::class, 'edit'])->name('edit')->can('update',Option::class);
    Route::post('/delete/{id}', [OptionController::class, 'delete'])->name('delete')->can('delete',Option::class);     
});

 