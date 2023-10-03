<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
use Illuminate\Support\Str;
class Repositories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:repositories {module} {--delete}';

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
        $module = ucfirst($this->argument('module'));
        $option = $this->option('delete');
        $pathModule = base_path('modules/' . $module);
        $pathRepositories = base_path('modules/' . $module.'/Repositories');
        $newRepositoriesInterface = $pathRepositories . '/' . $module."RepositoryInterface.php";
        $newRepositoriesBase = $pathRepositories . '/' . $module."Repository.php";
        $servicePath = app_path('Providers/AppServiceProvider.php'); 
        $contentService = file_get_contents($servicePath);
        //$contains = Str::contains($contentService, 'app->singleton');
        if($option === true){                        
            $newContent = "\$this->app->singleton(\n\t\t\Modules\\$module\Repositories\\$module"."RepositoryInterface::class,\n\t\t\Modules\\$module\Repositories\\$module"."Repository::class,\n\t\t);";
            $content = preg_replace('/^.*' . preg_quote($newContent, '/') . '.*\n?/m', '', $contentService);            
            $newContent = "\Modules\\$module\\Repositories\\$module"."Repository::class,";
            $content = preg_replace('/^.*' . preg_quote($newContent, '/') . '.*\n?/m', '', $content);
            file_put_contents($servicePath, $content);
            if (File::exists($newRepositoriesInterface)) {
                File::delete($newRepositoriesInterface);
            }
            if (File::exists($newRepositoriesBase)) {
                File::delete($newRepositoriesBase);
            }
            return $this->info('Module Repositories delete');
        }

        if (!File::exists($pathModule)) {
            $this->error('Module chua ton tai');
        } else { 
            
            if (!File::exists($pathRepositories)) {
                File::makeDirectory($pathRepositories, 0755, true, true);
            }
            $template = app_path('Console/Commands/template/RepositoryInterface.txt');
            if (File::exists($template)) {               
                $content = file_get_contents($template);
                $newContent = str_replace('{module}',$module, $content);               
                file_put_contents($newRepositoriesInterface, $newContent);
            }   

            $template = app_path('Console/Commands/template/BaseRepository.txt');
            if (File::exists($template)) {                
                $content = file_get_contents($template);
                $newContent = str_replace('{module}',$module, $content);               
                file_put_contents($newRepositoriesBase, $newContent);
                $newContent = "//singleton\n\t\$this->app->singleton(\n\t\t\Modules\\$module\Repositories\\$module"."RepositoryInterface::class,\n\t\t\Modules\\$module\Repositories\\$module"."Repository::class,\n\t\t);";                
                $content = str_replace('//singleton',$newContent, $contentService);
                file_put_contents($servicePath, $content);
                return $this->info('Module Repositories success');
                
             
            }   
            return $this->info('Module Repositories Fail');
        }
    }
}
