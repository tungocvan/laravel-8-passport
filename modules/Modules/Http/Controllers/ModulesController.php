<?php

namespace Modules\Modules\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Modules\Models\Modules;
use Modules\Modules\Repositories\ModulesRepositoryInterface;
use Modules\Modules\Repositories\ModulesRepository;
use File;

class ModulesController extends Controller
{  
    protected $ModulesRepo;
    public function __construct(ModulesRepositoryInterface $ModulesRepo)
    {
       // $this->middleware("auth");       
       $this->ModulesRepo = $ModulesRepo;
    }
    public function index()
    {
        // $Modules=$this->ModulesRepo->getAll();
        // or user ModulesRepository
        $Modules = new ModulesRepository();
        $data = $Modules->getModules()->all();        
        return getUrlView('modules',compact('data'));
    }
    public function add()
    {
        $Modules=$this->ModulesRepo->getAll();        
        // or user ModulesRepository               
        return getUrlView('modules/add');
    }
    public function store(Request $request)
    {
        
        $name = ucfirst($request->name) ?? '';
        $title = $request->description ?? '';
        
        if($name ==''){
           return redirect()->route('modules.add')->with('msg', "Không được bỏ trống tên Module");        
        }

        $pathModule = base_path('modules/' . $name);

        if(!File::exists($pathModule)) {
            return redirect()->route('modules.add')->with('msg', "Không tồn tại Module này.");
        }    

        $Modules=$this->ModulesRepo->create([
            'name' => $name,
            'title' => $title
        ]);
        // $Modules=$this->ModulesRepo->getAll();
        // or user ModulesRepository   
        // $Modules = new ModulesRepository();
        // $data = $Modules->getModules()->all();        
        // return getUrlView('modules',compact('data'));
        return redirect()->route('modules.index')->with('msg', "Thêm Modules thành công");
    }
    public function postDelete($id)
    {
        $Modules=$this->ModulesRepo->delete($id);
        return redirect()->route('modules.index')->with('msg', "Xóa Modules thành công");
    }
    public function edit(Modules $module)
    {
        return getUrlView('modules/edit',compact('module'));
    }
    public function postEdit($id,Request $request){  
        $name = ucfirst($request->name);    
        $pathModule = base_path('modules/' . $name);
        if(!File::exists($pathModule)) {
            return redirect()->route('modules.index')->with('msg', "Module bạn thay đổi không tồn tại này.");
        } 
        $data = [
            'name' => $name,
            'title' => $request->description
        ];
        $Modules=$this->ModulesRepo->update($id,$data);
        return redirect()->route('modules.index')->with('msg', "Cập nhật Modules thành công");
    }
}