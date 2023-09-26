<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use File;
use Illuminate\Support\Facades\Artisan;
class Middleware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-middleware {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create middleware Module CLI';

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
        $module = ucfirst($this->argument('module'));                 
        $nameMiddleware = $name . '.php';
        $pathMiddleware ='';
        if($module){
            $pathMiddleware = base_path('modules/' . $module.'/Http/Middleware'); 
            if(!File::exists($pathMiddleware)) {
                return $this->error('Module không tồn tại ');
            }            
        }else{
            $pathMiddleware = base_path('modules/' . $name.'/Http/Middleware');
        }
         
        $template = app_path('Console/Commands/template/middleware.txt');
        if (File::exists($template)) {
            $content = file_get_contents($template);     
            if($module){
                $newContent = str_replace('\\{module}\\',"\\$module\\", $content); 
                $newContent = str_replace('{module}',$name, $newContent);                 
            }else{
                $newContent = str_replace('{module}',$name, $content); 
            }
                                        
            $newMiddleware = $pathMiddleware . '/' . $nameMiddleware;         
            if(!File::exists($newMiddleware)) {                
                file_put_contents($newMiddleware, $newContent); 
                if($module){
                    Artisan::call('module:update-middleware', [
                        'name' => strtolower($name), 
                        'module' => $module                   
                    ]);
                }else{
                    Artisan::call('module:update-middleware', [
                        'name' => strtolower($name), 
                        'module' => null                   
                    ]);
                }  
                          
                
                $this->info('Create middleware Module success');
            }else{
                $this->error('middleware Module đã tồn tại ');
            }
            
        }
    }

}
