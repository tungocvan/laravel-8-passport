<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Product\Models\Product;
use Modules\Product\Repositories\ProductRepositoryInterface;
// use Modules\Product\Repositories\ProductRepository;
class ProductController extends Controller
{  
    protected $ProductRepo;
    public function __construct(ProductRepositoryInterface $ProductRepo)
    {
       // $this->middleware("auth");       
       $this->ProductRepo = $ProductRepo;
    }
    public function index()
    {
        // $Post=$this->PostRepo->getAll();
        // or user PostRepository
        // $Post = new PostRepository();
        
        return getUrlView('product');
    }
    public function add()
    {    
        return getUrlView('product/add');    
    }
    public function category()
    {    
        return getUrlView('product/category');    
    }
    public function tags()
    {    
        return getUrlView('product/tags');    
    }
    public function attributes()
    {    
        return getUrlView('product/attributes');    
    }
}