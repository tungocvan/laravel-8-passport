<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Post\Models\Post;
use Modules\Category\Models\Terms;
// use Modules\Post\Repositories\PostRepository;
use App\Http\Controllers\Controller;
use Modules\Category\Models\TermTaxonomy;
use Modules\Category\Models\TermRelationships;
use Modules\Post\Repositories\PostRepositoryInterface;

class PostController extends Controller
{  
    protected $PostRepo;
    public function __construct(PostRepositoryInterface $PostRepo)
    {
       // $this->middleware("auth");       
       $this->PostRepo = $PostRepo;
    }
    public function index()
    {
        // $Post=$this->PostRepo->getAll();
        // or user PostRepository
        // $Post = new PostRepository();
       
        return getUrlView('post');
    }
    public function add()
    {    
        
        return getUrlView('post/add');    
    }
    public function postAdd(Request $request)
    {    
        
        $name = $request->name;
        $slug = Str::slug($name);
        $parentCategoryId = $request->category[0];
        $description=$request->description;
        $newSubcategory = new Terms();  
        $newSubcategory->name = $name;
        $newSubcategory->slug = $slug;
        $newSubcategory->term_group = 0;
        $newSubcategory->save();
        // Thêm danh mục con vào danh mục sản phẩm gốc trong bảng wp_term_relationships
        $result = new TermRelationships();
        $result->object_id = $parentCategoryId;
        $result->term_taxonomy_id = $newSubcategory->term_id;
        $result->term_order = 0;
        $result->save();

        // Tạo mối quan hệ trong bảng wp_term_taxonomy
        $newTaxonomy = new TermTaxonomy();
        $newTaxonomy->term_id = $newSubcategory->term_id;
        $newTaxonomy->taxonomy = 'category';
        $newTaxonomy->parent = $parentCategoryId;
        $newTaxonomy->description = $description; // Mô tả của danh mục con
        $newTaxonomy->count = 0; // Số lượng sản phẩm trong danh mục con (có thể set là 0)   
        $newTaxonomy->save();

        return redirect()->route('post.category')->with('msg', "Thêm chuyên mục thành công");    
    }
    public function category()
    {    
        $data = Terms::all();  
        $category = Terms::all();                  
        return getUrlView('post/category',compact('data','category'));    
    }
    public function tags()
    {    
        return getUrlView('post/tags');    
    }
}