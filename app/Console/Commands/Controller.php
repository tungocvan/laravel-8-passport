<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use File;
use Illuminate\Support\Facades\Artisan;

class Controller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create controller Module CLI';

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
        $nameController = $this->argument('name').'Controller';             
        if($module){
            $pathController = base_path('modules/' . $module.'/Http/Controllers'); 
        }else{
            $pathController = base_path('modules/' . $name.'/Http/Controllers');
        }
        $template = app_path('Console/Commands/template/controller.txt');
        if (File::exists($template)) {
            $content = file_get_contents($template);
            if($module == null){
                $newContent = str_replace('{module}',$name, $content);
            }else{                
                $newContent = str_replace('\\{module}',"\\$module", $content); 
                $newContent = str_replace('{module}',$name, $newContent); 
         
            }
            
            if(File::exists($pathController)) {
                $newController = $pathController . '/' . $name . 'Controller.php';
                file_put_contents($newController, $newContent);
                $this->info('Create Controller Module success');
            }
            
        }

        if($module == null){
            $template = app_path('Console/Commands/template/apicontroller.txt');
            if (File::exists($template)) {
                $content = file_get_contents($template);
                $newContent = str_replace('{module}',$name, $content);
                if(File::exists($pathController)) {
                    $newController = $pathController . '//api//' . $name . 'Controller.php';
                    file_put_contents($newController, $newContent);
                    $this->info('Create API Controller Module success');
                }
                
            }
        }

      
    }
 
}
