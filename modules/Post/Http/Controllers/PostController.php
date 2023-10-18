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
    public function postAddCategory(Request $request)
    {    
        
        $name = $request->name;
        $slug = Str::slug($name);
        $parentCategoryId = $request->category[0];
        $description=$request->description ?? '';
        if($request->id){
            $newSubcategory= Terms::all()->where('term_id',$request->id)->first();            
            //dd($newSubcategory);
        }else{
            $newSubcategory = new Terms(); 
            $newSubcategory->term_group = 0;         
        }
        $newSubcategory->name = $name;
        $newSubcategory->slug = $slug; 
        
              
        $newSubcategory->save();
        // Thêm danh mục con vào danh mục sản phẩm gốc trong bảng wp_term_relationships
        if(!$request->id){
            $result = new TermRelationships();
            $result->object_id = $parentCategoryId;
            $result->term_taxonomy_id = $newSubcategory->term_id;
            $result->term_order = 0;
            $result->save();
        }    
        // Tạo mối quan hệ trong bảng wp_term_taxonomy
        if($request->id){
            $newTaxonomy= TermTaxonomy::all()->where('term_id',$request->id)->first();
        }else{
            $newTaxonomy = new TermTaxonomy(); 
            $newTaxonomy->term_id = $newSubcategory->term_id;  
            $newTaxonomy->taxonomy = 'category';          
            $newTaxonomy->count = 0; // Số lượng sản phẩm trong danh mục con (có thể set là 0)   
        }        
        $newTaxonomy->parent = $parentCategoryId;
        $newTaxonomy->description = $description; // Mô tả của danh mục con        
        $newTaxonomy->save();

        return redirect()->route('post.category')->with('msg', "Thêm chuyên mục thành công");    
    }
    public function postCategoryDelete(Request $request){

    }
    public function postCategoryEdit($id){
        //dd($id);
        $data = Terms::all();  
        $category = Terms::all();        
        $editData = $data->where('term_id',$id);                    
        foreach ($editData as $key => $value) {
            $key = $key; // Sẽ in ra 6
            break; // Dừng sau khi lấy được chỉ số đầu tiên
        }        
        $description=$data[$key]->termTaxonomy->description;       
        $parent = $data[$key]->termTaxonomy->parent;                                 
        //dd($editData);
        return getUrlView('post/category',compact('data','category','editData','description','parent','key'));
    }
    public function category()
    {    
        $data = Terms::all();  
        $category = Terms::all();        
        //dd($data[0]->termTaxonomy);                  
        return getUrlView('post/category',compact('data','category'));    
    }
    public function tags()
    {    
        return getUrlView('post/tags');    
    }
}