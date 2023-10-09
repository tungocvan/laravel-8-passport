<?php
 
namespace Modules\Users\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Users\Models\Users;
use Modules\Users\Repositories\UsersRepositoryInterface;
use Modules\Users\Repositories\UsersRepository;
class UsersController extends Controller
{  
    protected $UsersRepo;
    public function __construct(UsersRepositoryInterface $UsersRepo)
    {
       // $this->middleware("auth");       
       $this->UsersRepo = $UsersRepo; 
    }
    public function index()
    {
        //$Users=$this->UsersRepo->getAll();        
        // or user UsersRepository
        $Users = new UsersRepository();    
       //dd($Users->getUsers());
        return getUrlView('users',$Users->getPaginate(5));
    }
    public function add()
    {    
        return getUrlView('users/add');    
    }
    public function postAdd(Request $request)
    {    
        dd($request);
        return getUrlView('users/add');    
    }
    public function profile()
    {    
        return getUrlView('users/profile');    
    }
    public function permission()
    {    
        return getUrlView('users/permission');    
    }

    
}