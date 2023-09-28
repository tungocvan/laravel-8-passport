<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Sanctum\Http\Controllers\SanctumController;
 Route::middleware(['web','sanctum.middleware'])->prefix('/sanctum')->name('sanctum.')->group(function(){
     Route::get('/', [SanctumController::class, 'index'])->name('index');
});

 