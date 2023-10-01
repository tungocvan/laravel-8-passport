<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Product\Models\Product;
use Modules\Product\Repositories\ProductRepositoryInterface;

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
        // $Product=$this->ProductRepo->getAll();
        $title='Product View index.blade.php';
        return view('Product::index',compact('title'));
    }
}