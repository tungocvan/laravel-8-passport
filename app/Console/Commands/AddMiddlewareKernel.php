<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddMiddlewareKernel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:update-middleware {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $methodName = strtolower($name);
        $module = ucfirst($this->argument('module'));
        //$kernelFile = app_path('Http/Kernel.php');
        $kernelFile = 'modules/ModuleServiceProvider.php';
        if (!File::exists($kernelFile)) {
            $this->error('Kernel.php file not found!');
            return;
        }
        $content = file_get_contents($kernelFile);
        //protected $routeMiddleware = [

        $find = strstr($content, "{$methodName}.middleware", true);       
        if (!$find) {
            $foundString = 'add middleware';
            if($module){                
                $newString = "\n        '{$methodName}.middleware' => \\Modules\\{$module}\Http\Middleware\\{$name}::class,";
            }else{
                $newString = "\n        '{$methodName}.middleware' => \\Modules\\{$name}\Http\Middleware\\{$name}::class,";
            }
            
            $content = str_replace($foundString, $foundString . $newString, $content);
            file_put_contents($kernelFile, $content);
        }
        $this->info('Middleware added successfully!');
        return 0;
    }
}
