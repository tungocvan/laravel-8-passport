<?php

namespace Modules\Option\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Option\Models\Option;
use Modules\Option\Repositories\OptionRepositoryInterface;
// use Modules\Option\Repositories\OptionRepository;
class OptionController extends Controller
{  
    protected $OptionRepo;
    public function __construct(OptionRepositoryInterface $OptionRepo)
    {
       // $this->middleware("auth");       
       $this->OptionRepo = $OptionRepo;
    }
    public function index()
    {
        // $Option=$this->OptionRepo->getAll();
        // or user OptionRepository
        // $Option = new OptionRepository();
        
        $title='Option View index.blade.php';
        return view('Option::index',compact('title'));
    }
}