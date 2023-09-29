<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class Mysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:query {sql}';

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
        $sqlQuery = $this->argument('sql');
        $isSqlValid = preg_match("/^\s*(SELECT|INSERT|UPDATE|DELETE|SHOW)/i", $sqlQuery);
        if($isSqlValid){            
            try {
                $results = DB::statement($sqlQuery);
                //$results = DB::select($sqlQuery);
                if($results){
                    return $this->info("Truy vấn SQL đã thực hiện thành công!");                
                }
                return $this->error('Truy vấn SQL đã thực hiện thất bại!');
                
                
            } catch (\Exception $e) {
                // Xảy ra lỗi khi thực hiện truy vấn SQL
                // Bạn có thể in ra thông báo lỗi hoặc xử lý lỗi ở đây
                return $this->error('Truy vấn SQL đã thực hiện thất bại!');
            }

        }else{
            return $this->error('Chuỗi Mysql không hợp lệ');
        }
        
    }
}
