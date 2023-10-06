<?php

namespace Modules\Groups\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Groups\Models\Groups;
use Modules\Groups\Repositories\GroupsRepositoryInterface;
// use Modules\Groups\Repositories\GroupsRepository;
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
        // $Groups = new GroupsRepository();
        
        $title='Groups View index.blade.php';
        return view('Groups::index',compact('title'));
    }
}