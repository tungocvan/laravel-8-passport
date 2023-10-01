<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Users\Models\Users;
use Modules\Users\Repositories\UsersRepositoryInterface;

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
        // $Users=$this->UsersRepo->getAll();
        $title='Users View index.blade.php';
        return view('Users::index',compact('title'));
    }
}