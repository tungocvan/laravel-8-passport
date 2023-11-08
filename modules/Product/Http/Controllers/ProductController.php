<?php

namespace Modules\Product\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Category\Models\Terms;
use Modules\Product\Models\Product;
use App\Http\Controllers\Controller;
// use Modules\Product\Repositories\ProductRepository;
use Modules\Category\Models\TermTaxonomy;
use Modules\Category\Models\TermRelationships;
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
        $type = 'product_cat';
        //$type = 'category';        
        $category = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->select('nbw_terms.*','description','parent','count')->get();        
        $data = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->select('nbw_terms.*','description','parent','count')->get();        
        return getUrlView('product/category',compact('data','category'));    
    }
    public function tags()
    {    
        return getUrlView('product/tags');    
    }
    public function productAddCategory(Request $request)
    {    
        $type = 'product_cat';
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
            $newTaxonomy->taxonomy = $type;          
            $newTaxonomy->count = 0; // Số lượng sản phẩm trong danh mục con (có thể set là 0)   
        }        
        $newTaxonomy->parent = $parentCategoryId;
        $newTaxonomy->description = $description; // Mô tả của danh mục con        
        $newTaxonomy->save();

        return redirect()->route('product.category')->with('msg', "Thêm chuyên mục thành công"); 
    }

    public function productCategoryDelete($id){     
        $termRelationships= TermRelationships::where('object_id',$id)->get();
        if($termRelationships->count() > 0 ) {
            foreach ($termRelationships as $key => $item) {                     
                $terms = Terms::find($item->term_taxonomy_id);
                $terms->delete();
                $taxonomy= TermTaxonomy::where('term_id',$item->term_taxonomy_id);
                $taxonomy->delete();
            }    
        }
        $terms = Terms::find($id);
        $terms->delete();
        $taxonomy= TermTaxonomy::where('term_id',$id);
        $taxonomy->delete();        
        $termRelationships= TermRelationships::where('term_taxonomy_id',$id);
        $termRelationships->delete();        
        
        
        
        return redirect()->route('product.category')->with('msg', "Xóa chuyên mục thành công");
    }
    public function productCategoryEdit($id){
        //dd($id);
        $type = 'product_cat';
        //$type = 'category';        
        $category = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->select('nbw_terms.*','description','parent','count')->get();        
        $data = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->select('nbw_terms.*','description','parent','count')->get();                
        $editData = $data->where('term_id',$id);                    
        foreach ($editData as $key => $value) {
            $key = $key; // Sẽ in ra 6
            break; // Dừng sau khi lấy được chỉ số đầu tiên
        }        
        $description=$data[$key]->description;       
        $parent = $data[$key]->parent;                                 
        //dd($editData);
        return getUrlView('product/category',compact('data','category','editData','description','parent','key'));
    }

    public function attributes()
    {    
        return getUrlView('product/attributes');    
    }
}