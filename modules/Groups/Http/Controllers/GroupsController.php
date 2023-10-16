<?php

namespace Modules\Groups\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Groups\Models\Groups;
use Modules\Modules\Models\Modules;
use App\Http\Controllers\Controller;
use Modules\Groups\Repositories\GroupsRepository;
use Modules\Groups\Repositories\GroupsRepositoryInterface;

class GroupsController extends Controller
{  
    protected $GroupsRepo;
    public function __construct(GroupsRepositoryInterface $GroupsRepo)
    {
       // $this->middleware("auth");       
       $this->GroupsRepo = $GroupsRepo;
    }
    public function index()
    {
        // $Groups=$this->GroupsRepo->getAll();
        // or user GroupsRepository
        $Groups = new GroupsRepository();
        //dd($Groups->getGroups()->all()) ;
        $data = $Groups->getGroups()->all();
        return getUrlView('groups',compact('data'));
    }
    public function add()
    {
        return getUrlView('groups/add');
    }
    public function postAdd(Request $request)
    {
        $name = ucfirst($request->name);
        $check = Groups::where('name',$name)->get();
        if($check->count() === 0){
            $this->GroupsRepo->create(['name' => $name, 'user_id' => 1]);            
            return redirect()->route('groups.index')->with('msg', "Thêm nhóm mới thành công"); 
        }
        return redirect()->route('groups.index')->with('msg', "Nhóm bạn tạo đã có"); 
    }
    public function permission(Groups $group)
    {
        // $Groups=$this->GroupsRepo->getAll();
        // or user GroupsRepository
        //$Groups = new GroupsRepository();
        //dd($Groups->getGroups()->all()) ;
        //$data = $Groups->getGroups()->all();  
        $modules = Modules::all();      
        $roleListArr = [
            "view" => "Xem",
            "create" => "Thêm",
            "update" => "Sửa",
            "delete" => "Xóa"
        ];
        $roleJson = $group->permissions;
        if(!empty($roleJson)){
            $roleArr= json_decode($roleJson,true);
        }else{
            $roleArr= [];
        }
        $data = [
            'roleListArr' => $roleListArr,
            'roleArr' => $roleArr,
            'modules' => $modules,
            'group' => $group
        ];

        return getUrlView('groups/permission',compact('data'));
    }

    public function postPermission(Groups $group, Request $request)
    {

        //dd($group);
        if(!empty($request->role)){
            $roleArr = $request->role;
        }else{
            $roleArr = [];
        }
        $roleJson = json_encode($roleArr);        
        $group->permissions =  $roleJson ;        
        //dd($roleJson);
        $group->save();        
        return redirect()->route('groups.index')->with('msg', "Phân quyền thành công !");
        
    }
} 