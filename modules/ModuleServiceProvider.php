<?php
namespace Modules;
use File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
    }
    private $middlewares = [
        //add middleware
        'post.middleware' => \Modules\Post\Http\Middleware\Post::class,
        'env.middleware' => \Modules\Env\Http\Middleware\Env::class
    ];
    private $commands = [
        // TestCommand::class
    ];
    public function boot()
    {
        // Đăng ký modules theo cấu trúc thư mục
        //$directories = array_map('basename' , File::directories( __DIR__)) ;
        $modules = $this->getModules();
        foreach ($modules as $module) {
            $this->registerModule($module);
        }

        // Middlewares
        $this->registerMiddlewares();
        //Commands
        //$this->commands($this->commands);
    }
    // Khai báo đăng ký cho từng modules
    private function registerModule($module)
    {
        $modulePath = __DIR__ . "/{$module}";
        // Khai báo thành phần ở đây
        // Khai báo route
        if (File::exists($modulePath . '/Routes/web.php')) {
            $this->loadRoutesFrom($modulePath . '/Routes/web.php');
            $this->loadRoutesFrom($modulePath . '/Routes/api.php');
        }

        // Khai báo migration
        // Toàn bộ file migration của modules sẽ tự động được load
        if (File::exists($modulePath . '/Database/migrations')) {
            $this->loadMigrationsFrom($modulePath . '/Database/migrations');
        }

        // Khai báo languages
        if (File::exists($modulePath . '/Resources/lang')) {
            // Đa ngôn ngữ theo file php
            // Dùng đa ngôn ngữ tại file php resources/lang/en/general. php : @lang( ' Demo: : general. hello' ) Laravel Modules 4
            $this->loadTranslationsFrom($modulePath . '/Resources/lang', $module);
            // Đa ngôn ngữ theo file j son
            $this->loadJSONTranslationsFrom($modulePath . '/Resources/lang');
        }

        // Khai báo views
        // Gọi view thì ta sử dụng: view( ' Demo: : index' ) , @extends( ' Demo: : index' ) , @include( ' Demo: : index' )
        if (File::exists($modulePath . '/Resources/views')) {
            $this->loadViewsFrom($modulePath . '/Resources/views', $module);
        }

        // Khai báo helpers
        if (File::exists($modulePath . '/Helpers')) {
            // Tất cả files có tại thư mục helpers
            $helper_dir = File::allFiles($modulePath . '/Helpers');
            // khai báo helpers
            foreach ($helper_dir as $key => $value) {
                $file = $value->getPathName();
                require $file;
            }
        }
    }

    private function getModules()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }
    private function registerConfig($module)
    {
    }
    private function registerMiddlewares()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }
}
