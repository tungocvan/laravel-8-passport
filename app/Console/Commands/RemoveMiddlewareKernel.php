<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveMiddlewareKernel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:remove-middleware {name}';

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
        //$kernelFile = app_path('Http/Kernel.php');
        $kernelFile = 'modules/ModuleServiceProvider.php';
        if (!File::exists($kernelFile)) {
            $this->error('Kernel.php file not found!');
            return;
        }
        $content = file_get_contents($kernelFile);
        //$foundString = "'{$methodName}.middleware' => \\Modules\\{$name}\Http\Middleware\\{$name}::class,"; 
        $foundString = "'{$methodName}.middleware' => \\Modules\\{$name}\Http\Middleware\\{$name}::class,";         
        if ($foundString) {                                   
            $content = preg_replace('/^.*' . preg_quote($foundString, '/') . '.*\n?/m', '', $content);
            file_put_contents($kernelFile, $content);
            $this->info('Middleware Remove successfully!');
        }else{
            $this->info('Middleware Remove Fail!');
        }
        
        return 0;
    }
}
