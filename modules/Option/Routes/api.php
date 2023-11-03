<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Option\Http\Controllers\api\OptionController;
 Route::middleware(['api'])->prefix('/api/option')->name('api.option.')->group(function(){
     Route::get('/', [OptionController::class, 'index'])->name('index');
});
 
  