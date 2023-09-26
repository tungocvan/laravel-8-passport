<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use File;

class Routes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-routes {name}';

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
        $moduleName = $this->argument('name');
        $name = ucfirst($moduleName);        
        $pathroutes = base_path('modules/' . $name.'/Routes');    
        $template = app_path('Console/Commands/template/routes.txt');
        if (File::exists($template)) {
            $content = file_get_contents($template);
            $newContent = str_replace('{module}',$name, $content);
            $newContent = str_replace('{moduleName}',$moduleName, $newContent);
            $webRoutes = $pathroutes . '/web.php';
            if(!File::exists($webRoutes)) {                
                file_put_contents($webRoutes, $newContent);
                $this->info('Create routes web Module success');
            }else{
                $this->error('Routes web đã tồn tại');
            }
            
        }
        $template = app_path('Console/Commands/template/api.txt');
        if (File::exists($template)) {
            $content = file_get_contents($template);
            $newContent = str_replace('{module}',$name, $content);
            $newContent = str_replace('{moduleName}',$moduleName, $newContent);
            $webRoutes = $pathroutes . '/api.php';
            if(!File::exists($webRoutes)) {                
                file_put_contents($webRoutes, $newContent);
                $this->info('Create routes api Module success');
            }else{
                $this->error('Routes api đã tồn tại');
            }
            
        }
    }

}
