<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use File;

class Policy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-policy {module} {--delete}';

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
        $option = $this->option('delete');     
        $module = ucfirst($this->argument('module'));           
        $varModule = strtolower($this->argument('module'));           
        $namePolicy = $module . 'Policy.php';
        $pathModule = base_path('modules/' . $module);    
                      
        if(!File::exists($pathModule)) {
            return $this->error('Module không tồn tại ');
        }            
        if($option === false){
            $pathPolicy = base_path('modules/' . $module.'/Policies');
            if (!File::exists($pathPolicy)) {
                File::makeDirectory($pathPolicy, 0755, true, true);
            }
            $template = app_path('Console/Commands/template/policy.txt');
            if (File::exists($template)) {
                $content = file_get_contents($template);          
                
                $newContent = str_replace('{module}',$module, $content);
                $newContent = str_replace('{varModule}',$varModule, $newContent);
                $newPolicy = $pathPolicy . '/' . $namePolicy;
                if(!File::exists($newPolicy)) {                           
                    file_put_contents($newPolicy, $newContent);
                    $providerPath = app_path("Providers/AuthServiceProvider.php");
                    if (File::exists($providerPath)){
                        $content = file_get_contents($providerPath);
                        $find = 'namespace App\Providers;';
                        $module = ucfirst($module);
                        $policy = "use Modules\\$module\\Policies\\$module"."Policy;";
                        $position = strpos($content, $policy); // hàm tìm kiếm chuỗi con 
                        if($position == false){
                            $model = "use Modules\\$module\\Models\\$module;";
                            $newContent = $find."\n\n".$model."\n".$policy."\n";
                            $content = str_replace($find,$newContent,$content);
                            file_put_contents($providerPath, $content);        
                            $content = file_get_contents($providerPath);
                            $find = 'protected $policies = [';
                            $newContent = $find."\n"."\t\t$module::class => $module"."Policy"."::class,";
                            $content = str_replace($find,$newContent,$content);
                            file_put_contents($providerPath, $content);
                        } 
                        
                    }
                    $this->info('Create Policy Module success');
                }else{
                    $this->error('Policy Module đã tồn tại ');
                }
            }

        }else{
            $providerPath = app_path("Providers/AuthServiceProvider.php");
            $contentService = file_get_contents($providerPath);
            $policy = "use Modules\\$module\\Policies\\$module"."Policy;";
            $content = preg_replace('/^.*' . preg_quote($policy, '/') . '.*\n?/m', '', $contentService); 
            $model = "use Modules\\$module\\Models\\$module;";
            $content = preg_replace('/^.*' . preg_quote($model, '/') . '.*\n?/m', '', $content); 
            $policies = "$module::class => $module"."Policy"."::class,";
            $content = preg_replace('/^.*' . preg_quote($policies, '/') . '.*\n?/m', '', $content); 
            file_put_contents($providerPath, $content);
        }
    }
}
