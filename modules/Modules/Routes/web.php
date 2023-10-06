<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Modules\Http\Controllers\ModulesController;
 Route::middleware(['web','modules.middleware'])->prefix('/modules')->name('modules.')->group(function(){
     Route::get('/', [ModulesController::class, 'index'])->name('index');
});

 