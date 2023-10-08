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
            "add" => "Thêm",
            "edit" => "Sửa",
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
} 