<?php

namespace App\Providers;
use App\View\Components\InputTextArea;
use App\View\Components\InputCheck;
use App\View\Components\InputSelect;
use App\View\Components\editor;
use App\View\Components\InputDate;
use App\View\Components\InputFile;
use App\View\Components\InputText;
use App\View\Components\UploadFile;
use Illuminate\Pagination\Paginator;
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
        //singleton
	$this->app->singleton(
		\Modules\Category\Repositories\CategoryRepositoryInterface::class,
		\Modules\Category\Repositories\CategoryRepository::class,
		);
	$this->app->singleton(
		\Modules\Groups\Repositories\GroupsRepositoryInterface::class,
		\Modules\Groups\Repositories\GroupsRepository::class,
		);
	$this->app->singleton(
		\Modules\Modules\Repositories\ModulesRepositoryInterface::class,
		\Modules\Modules\Repositories\ModulesRepository::class,
		);
	$this->app->singleton(
		\Modules\Product\Repositories\ProductRepositoryInterface::class,
		\Modules\Product\Repositories\ProductRepository::class,
		);
	$this->app->singleton(
		\Modules\Post\Repositories\PostRepositoryInterface::class,
		\Modules\Post\Repositories\PostRepository::class,
		);
	$this->app->singleton(
		\Modules\Admin\Repositories\AdminRepositoryInterface::class,
		\Modules\Admin\Repositories\AdminRepository::class,
		);
	$this->app->singleton(
		\Modules\Users\Repositories\UsersRepositoryInterface::class,
		\Modules\Users\Repositories\UsersRepository::class,
		);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		Paginator::useBootstrap();
		//boot 
	Blade::component('input-text-area', InputTextArea::class); 
	Blade::component('input-check', InputCheck::class); 
	Blade::component('input-select', InputSelect::class); 
	Blade::component('input-file', InputFile::class); 
	Blade::component('input-date', InputDate::class); 
	Blade::component('input-text', InputText::class); 	
	Blade::component('editor', editor::class); 
	Blade::component('upload-file', UploadFile::class); 
    }
}
