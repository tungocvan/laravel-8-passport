<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use File;

class Component extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'component:make {name} {--delete}';

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
        $nameComp = $this->argument('name'); 
        $myoption = $this->option('delete');
        $compFile = base_path('app/View/Components/' . $nameComp . '.php');        
        $servicePath = app_path('Providers/AppServiceProvider.php'); 
        $content = file_get_contents($servicePath);
        $str = preg_replace('/[^a-zA-Z0-9]+/', '-', $nameComp);
        $packageComp = strtolower(preg_replace('/([a-z])([A-Z])/', '$1-$2', $str)); // thêm dấu gạch ngang vào phía trước các ký tự chữ hoa và chuyển chuỗi thành chữ thường
        $viewFile = base_path('resources/views/components/' . $packageComp . '.blade.php');
        $newContent ="use App\View\Components\\$nameComp;";
        if (!File::exists($compFile) && $myoption === false) {
            Artisan::call('make:component', ['name' => $nameComp]);             
            $content = str_replace('namespace App\Providers;',"namespace App\Providers;\n". $newContent, $content);
            $newContent ="\tBlade::component('$packageComp', $nameComp::class);";
            $content = str_replace('//boot',"//boot \n". $newContent, $content);
            file_put_contents($servicePath, $content);
            $this->info("Đã tao thanh cong:",$packageComp);
        }else{
            if($myoption === true){
                $content = preg_replace('/^.*' . preg_quote($newContent, '/') . '.*\n?/m', '', $content);                
                $newContent ="Blade::component('$packageComp', $nameComp::class);";                
                $content = preg_replace('/^.*' . preg_quote($newContent, '/') . '.*\n?/m', '', $content); 
                file_put_contents($servicePath, $content);
                if (File::exists($compFile)) {
                    File::delete($compFile);
                }
                if (File::exists($viewFile)) {
                    File::delete($viewFile);
                }
                
                $this->info("Đã xoa thanh cong");
            }else{
                $this->info("Đã ton tai");
            }
        }

        //$status = Artisan::call('make:component', ['name' => $nameComp]); 
       
        //dd($status);
        //$compFile = base_path('app/View/Components/' . $nameComp . '.php');
        
    }
}
