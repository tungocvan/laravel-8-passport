<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
class RemoveObservers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'observers:remove {name} {module}';

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
                return $this->error('Observer không tồn tại ');
            }  
            $newModel ="use Modules\\$module\Models\\$module;";
            $newObserver ="use Modules\\$module\\Observers\\$module"."Observer;";
            $bootObserver = "$module::observe(new $module"."Observer);";
        }else{
            $pathObserver = base_path('modules/' . $name.'/Observers');
            $newModel ="use Modules\\$name\Models\\$name;";                    
            $newObserver ="use Modules\\$name\\Observers\\$name"."Observer;";
            $bootObserver = "$name::observe(new $name"."Observer);";
        }
        $servicePath = app_path('Providers/EventServiceProvider.php');
        $content = file_get_contents($servicePath);
        $content = preg_replace('/^.*' . preg_quote($newModel, '/') . '.*\n?/m', '', $content);
        $content = preg_replace('/^.*' . preg_quote($newObserver, '/') . '.*\n?/m', '', $content);
        $content = preg_replace('/^.*' . preg_quote($bootObserver, '/') . '.*\n?/m', '', $content);
        file_put_contents($servicePath, $content);
        $this->info('Observer Remove successfully!');
    }
}
