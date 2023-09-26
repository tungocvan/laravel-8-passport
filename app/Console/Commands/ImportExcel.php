<?php

namespace App\Console\Commands;
//use App\Models\Thuoc;
use App\Imports\CollectionImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use File;

class ImportExcel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:excel {name} {model} {module=null}';
    // Tạo 1 model -> tạo bảng tương ứng với model -> file excel import nằm trong thư mục gốc của storage -> file excel tương ứng các cột trong table

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import File Excel to Database Mysql';

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
        $file = $this->argument('name');
        $model = ucfirst($this->argument('model'));
        $module = ucfirst($this->argument('module'));
        if($module=="Null"){     
            $pathModel = base_path('app/Models/' . $model.".php");
            if (File::exists($pathModel)) {
                $model = app("App\Models\\$model");
                
            }else{
                return $this->error("Không tồn tại model $model"); 
            }
            
        }else{            
            $pathModel = base_path("modules/$module/Models/" . $model.".php");
            if (File::exists($pathModel)) {
                $model = app("Modules\\$module\Models\\$model");                
            }else{
                return $this->error("Không tồn tại model $model"); 
            }   
            
        }
        
        $sql_file = storage_path().'/'.$file;
        if(!file_exists($sql_file)){
            $this->info("kiểm tra file $file có nằm trong storage");            
        }else{
            //$model = new Thuoc();           
            $status = $this->ExceltoArrayUpload($sql_file,$model);
            $this->info($status);
        }
    }

    function ExceltoArrayUpload($file,$model)
        {
            $products = Excel::toArray(new CollectionImport(), $file);
            $items = [];
            $chunkSize = 0; // kích thước của từng lô dữ liệu
            $itemsCount = 0;
            foreach ($products[0] as $key => $product) {
                $temp = [];
                if ($key > 0) {
                    foreach ($product as $i => $item) {
                        $itemTemp = (string) $products[0][$key][$i];
                        $temp[$products[0][0][$i]] = $itemTemp;
                    }
                    $chunkSize = $chunkSize + 1;
                    array_push($items, $temp);
                    if ($chunkSize == 2000) {
                        // Ghi vào database
                        echo "Bắt đầu ghi... \n";
                        $model->insert($items);
                        $itemsCount = $itemsCount + $chunkSize;
                        $chunkSize = 0;
                        $items = [];
                        echo "Đã import xong $itemsCount bản ghi. \n";
                    }

                    //$status = $this->woocommerce->addProduct($temp);
                }
            }

            if (count($items) > 0) {
                $itemsCount = (string) (count($items) + $itemsCount);
                $model->insert($items);
                echo "Đã import xong $itemsCount bản ghi. \n";
            }

            return 'Đã import xong.';
        }

}
