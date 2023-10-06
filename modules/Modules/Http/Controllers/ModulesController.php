<?php

namespace Modules\Modules\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Modules\Models\Modules;
use Modules\Modules\Repositories\ModulesRepositoryInterface;
// use Modules\Modules\Repositories\ModulesRepository;
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
        // $Modules = new ModulesRepository();
        
        $title='Modules View index.blade.php';
        return view('Modules::index',compact('title'));
    }
}