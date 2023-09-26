<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
class Observers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'observers:make {name} {module}';

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
        $module = ucfirst($this->argument('module'));        
        $nameObserver = $name . 'Observer.php';
        if($module){
            $pathObserver = base_path('modules/' . $module.'/Observers'); 
            if(!File::exists($pathObserver)) {
                return $this->error('Module không tồn tại ');
            }  
        }else{
            $pathObserver = base_path('modules/' . $name.'/Observers');
        }
        $template = app_path('Console/Commands/template/observers.txt');
        if (File::exists($template)) {
            $content = file_get_contents($template); 
            if($module == null){
                $newContent = str_replace('{module}',$name, $content);
            }else{                
                $newContent = str_replace('{module}',$module, $content);
            }                                     
            $newObserver = $pathObserver . '/' . $nameObserver;
            if(!File::exists($newObserver)) {                
                file_put_contents($newObserver, $newContent);
                // cập nhật file EventServiceProvider.php
                $servicePath = app_path('Providers/EventServiceProvider.php');
                $content = file_get_contents($servicePath);
                if($module == null){
                    $newModel ="use Modules\\$name\Models\\$name;";                    
                    $newObserver ="use Modules\\$name\\Observers\\$name"."Observer;";
                    $newContent = str_replace('namespace App\Providers;',"namespace App\Providers;\n".$newModel."\n".$newObserver, $content);
                    $newContent = str_replace('//observe',"//observe\n"."\t\t$name::observe(new $name"."Observer);", $newContent);
                }else{                
                    $newModel ="use Modules\\$module\Models\\$module;";
                    $newObserver ="use Modules\\$module\\Observers\\$module"."Observer;";
                    $newContent = str_replace('namespace App\Providers;',"namespace App\Providers;\n".$newModel."\n".$newObserver, $content);
                    $newContent = str_replace('//observe',"//observe\n"."\t\t$module::observe(new $module"."Observer);", $newContent);
                }  
                file_put_contents($servicePath, $newContent);               
                $this->info('Create Observer Module success');
            }else{
                $this->error('Observer Module đã tồn tại ');
            }
            
        }
        
    }
}
