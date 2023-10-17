<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;
use Modules\Category\Repositories\CategoryRepositoryInterface;
// use Modules\Category\Repositories\CategoryRepository;
class CategoryController extends Controller
{  
    protected $CategoryRepo;
    public function __construct(CategoryRepositoryInterface $CategoryRepo)
    {
       // $this->middleware("auth");       
       $this->CategoryRepo = $CategoryRepo;
    }
    public function index()
    {
        // $Category=$this->CategoryRepo->getAll();
        // or user CategoryRepository
        // $Category = new CategoryRepository();
        
        $title='Category View index.blade.php';
        return view('Category::index',compact('title'));
    }
}