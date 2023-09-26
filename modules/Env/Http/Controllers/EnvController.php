<?php

namespace Modules\Env\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Env\Models\Env;
use Illuminate\Support\Facades\DB;

class EnvController extends Controller
{  
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $envFilePath = base_path('.env');
        $envArray = getEnvToArray($envFilePath); 
        $title ='Thiết lập tham số ENV';
        $connect = $this->checkDatabaseConnection();
        return view('Env::index',compact('envArray','title','connect')); 
    }
    public function postEnv(Request $request)
    {
        $action = $request->action;        
        switch ($action) {
            case 'Thêm':
                $data = [];            
                $data[$request->key] = $request->value;
                setEnv($data);
                break;            
            case 'Xóa':                                                                                   
                setEnv($request->all(),$request->key);
                break;            
            default:
                $newEnvData = $request->except(['_token']);
                setEnv($newEnvData);
                break;
        }

        return back()->with('status','cập nhật thành công.');
    }
    public function checkDatabaseConnection() {
        try {
            DB::connection()->getPdo();
            return true; // Kết nối thành công
        } catch (\Exception $e) {
            return false; // Kết nối thất bại
        }
    }
}