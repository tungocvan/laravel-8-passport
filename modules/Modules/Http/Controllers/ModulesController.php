<?php

namespace Modules\Modules\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Modules\Models\Modules;
use Modules\Modules\Repositories\ModulesRepositoryInterface;
use Modules\Modules\Repositories\ModulesRepository;
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
        
        $name = $request->name ?? '';
        $title = $request->description ?? '';
        if($name ==''){
           return redirect()->route('modules.index');        
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
        dd($module);
        return 'sEdit';
        $Modules=$this->ModulesRepo->delete($id);
        return redirect()->route('modules.index')->with('msg', "Xóa Modules thành công");
    }
    public function postEdit(Request $request)
    {
        return 'postEdit';
        $Modules=$this->ModulesRepo->delete($id);
        return redirect()->route('modules.index')->with('msg', "Xóa Modules thành công");
    }
}