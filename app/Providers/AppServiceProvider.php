<?php

namespace App\Providers;
use App\View\Components\editor;
use App\View\Components\InputDate;
use App\View\Components\InputFile;
use App\View\Components\InputText;
use App\View\Components\UploadFile;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->singleton(		
		//singleton
		\Modules\Users\Repositories\UsersRepositoryInterface::class,
		\Modules\Users\Repositories\UsersRepository::class,
		\Modules\Product\Repositories\ProductRepositoryInterface::class,
		\Modules\Product\Repositories\ProductRepository::class,
		);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //boot 
	Blade::component('input-file', InputFile::class); 
	Blade::component('input-date', InputDate::class); 
	Blade::component('input-text', InputText::class); 	
	Blade::component('editor', editor::class); 
	Blade::component('upload-file', UploadFile::class); 
    }
}
