<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Models\Admin;
use Modules\Admin\Repositories\AdminRepositoryInterface;
// use Modules\Admin\Repositories\AdminRepository;
class AdminController extends Controller
{  
    protected $AdminRepo;
    public function __construct(AdminRepositoryInterface $AdminRepo)
    {
       // $this->middleware("auth");       
       $this->AdminRepo = $AdminRepo;
    }
    public function index()
    {
        // $Admin=$this->AdminRepo->getAll();
        // or user AdminRepository
        // $Admin = new AdminRepository();
        
        $title='admin';
        return view('Admin::phoenix.phoenix',compact('title'));
    }
}