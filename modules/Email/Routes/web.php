<?php 
 use Illuminate\Support\Facades\Route;
 use Modules\Email\Http\Controllers\EmailController;
 Route::middleware(['web','email.middleware'])->prefix('/email')->name('email.')->group(function(){
     Route::get('/', [EmailController::class, 'index'])->name('index');
});

 