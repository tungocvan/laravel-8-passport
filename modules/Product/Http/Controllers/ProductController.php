<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Product\Models\Product;
use Modules\Product\Repositories\ProductRepositoryInterface;
// use Modules\Product\Repositories\ProductRepository;
use Modules\Category\Models\Terms;
use Modules\Category\Models\TermTaxonomy;
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
        //$type = 'product_cat';
        $type = 'category';
        //$data = Terms::all();  
        $category = Terms::all();     
        //$category = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->pluck('name','nbw_terms.term_id');   
        //$category = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->pluck('name','nbw_terms.term_id');   
        dd($category);
        //dd($data[0]->termTaxonomy);                  
        //return getUrlView('post/category',compact('data','category'));  
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