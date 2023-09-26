<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use File;

class Models extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-models {name} {module}';

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
        $nameModels = $name . '.php';
        $pathModels ='';
        if($module){
            $pathModels = base_path('modules/' . $module.'/Models'); 
            if(!File::exists($pathModels)) {
                return $this->error('Module không tồn tại ');
            }  
        }else{
            $pathModels = base_path('modules/' . $name.'/Models');
        }
         
        $template = app_path('Console/Commands/template/models.txt');
        if (File::exists($template)) {
            $content = file_get_contents($template); 
            if($module == null){
                $newContent = str_replace('{module}',$name, $content);
            }else{
                $newContent = str_replace('\\{module}',"\\$module", $content); 
                $newContent = str_replace('{module}',$name, $newContent);
            }                          
           
            $newModels = $pathModels . '/' . $nameModels;
            if(!File::exists($newModels)) {                
                file_put_contents($newModels, $newContent);
                $this->info('Create Models Module success');
            }else{
                $this->error('Models Module đã tồn tại ');
            }
            
        }
    }

}
