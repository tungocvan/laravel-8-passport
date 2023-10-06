<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Modules\Http\Controllers\api\ModulesController;
 Route::middleware(['api'])->prefix('/api/modules')->name('api.modules.')->group(function(){
     Route::get('/', [ModulesController::class, 'index'])->name('index');
});
 
  