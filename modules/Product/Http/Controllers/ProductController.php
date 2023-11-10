<?php

namespace Modules\Product\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Post\Models\Post;
use Modules\Post\Models\PostMeta;
use Modules\Category\Models\Terms;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Models\Product;
use App\Http\Controllers\Controller;
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
        $Post = new ProductRepository();        
        $allPost = $Post->getPaginate(3);
        // //dd($allPost);
        // $posts = [];
        // // dd($allPost[13]->postMeta[0]->post_id);
        // foreach ($allPost as $key => $post) {               
        //     // if($post->postMeta){              
        //     //     if($post->postMeta[0]->meta_key == '_thumbnail_id'){
        //     //         $image = $post->postMeta[0]->meta_value;
        //     //     }        
        //     //     if($post->postMeta[0]->meta_key == '_price'){
        //     //         $price = $post->postMeta[0]->meta_value;
        //     //     }        

        //     // }            
        //     $id = $post->ID;  
        //     $title = $post->post_title;
        //     $postMeta = PostMeta::where('post_id',$id)->get();     
            
        //     if($postMeta->count() > 0){ 
        //         foreach ($postMeta as $key => $post) { 
        //             if($post->meta_key == '_thumbnail_id'){
        //                 $image = $post->meta_value;
        //             }
        //             if($post->meta_key == '_price'){
        //                 $price = $post->meta_value;
        //             }
        //             if($post->meta_key == '_regular_price'){
        //                 $regular_price = $post->meta_value;
        //             }

        //         }
        //     }
            
        //     $TermRelationships = TermRelationships::select('term_taxonomy_id')->where('object_id',$id)->get();   
            
        //     $category = [];
        //     foreach ($TermRelationships as $key => $value) {                
        //         $cateSlug = Terms::select('term_id','slug')->where('term_id',$value->term_taxonomy_id)->first();                                 
        //         array_push($category,$cateSlug);
                
        //     }
        //     $itemPost = [
        //         'ID' => $id,
        //         'title' => $title,  
        //         'image' => $image ?? '',
        //         'category' => $category,
        //         'price' => $price,
        //         'regular_price' => $regular_price,
        //     ];            
        //     array_push($posts,$itemPost);
            
        // }
        //dd($posts);
        return getUrlView('product',compact('allPost'));
    }
    public function add()
    {    
        $type = 'product_cat';
        $category = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->select('nbw_terms.*','description','parent','count')->get();                
        return getUrlView('product/add',compact('category'));    
    }

    public function productAdd(Request $request)
    {    
       
        //dd($request);
        $newPost = new Post;
        $newPost->post_title = $request->post_title;
        $newPost->post_excerpt = $request->post_excerpt;
        $newPost->post_content = $request->post_content;
        $newPost->post_status = 'publish';      
        $newPost->post_type = 'product';
        $price = $request->_price ?? 0;
        $regular_price = $request->_regular_price ?? 0;        
        $newPost->save();
        $id = $newPost->ID;
        $category = $request->category;        
        if(count($category) > 0){
            foreach ($category as $value) {
                $categoryTerm = Terms::find($value);
                $result = new TermRelationships();
                $result->object_id = $id;
                $result->term_taxonomy_id = $categoryTerm->term_id;
                $result->term_order = 0;
                $result->save();
                $newTaxonomy= TermTaxonomy::all()->where('term_id',$value)->first();
                $newTaxonomy->count = $newTaxonomy->count + 1;
                $newTaxonomy->save();
            }
        }

        if($request->thumnail[0]){
            $postMeta = new PostMeta;
            $postMeta->post_id = $id;
            $postMeta->meta_key = '_thumbnail_id';
            $postMeta->meta_value = $request->thumnail[0];
            $postMeta->save();
        }    

       
        $postMeta = new PostMeta;
        $postMeta->post_id = $id;
        $postMeta->meta_key = '_price';
        $postMeta->meta_value = $price ;
        $postMeta->save();

        
        $postMeta = new PostMeta;
        $postMeta->post_id = $id;
        $postMeta->meta_key = '_regular_price';
        $postMeta->meta_value = $regular_price ;
        $postMeta->save();

        return redirect()->route('product.index')->with('msg', "Đã thêm sản phẩm thành công");  
    }


    public function productEdit($id)
    {    
         // dd($id);
          //dd(getCategoriesByIdPost($id));          
          $post = Post::where('ID',$id)->first();          
          if($post){
                $checked=[];$meta=[];
                //dd(getCategoriesByIdPost($id));
                foreach (getCategoriesByIdPost($id) as $item) {
                    array_push($checked,$item->term_id);
                }
                $postMeta = PostMeta::where('post_id',$id)->get();
                foreach ($postMeta as $key => $item) {       
                    $meta[$item->meta_key] = $item->meta_value;                                 
                }
               
               $type = 'product_cat';
               $category = TermTaxonomy::join('nbw_terms', 'nbw_term_taxonomy.term_id', '=', 'nbw_terms.term_id')->where('taxonomy', $type)->select('nbw_terms.*','description','parent','count')->get();                
               return getUrlView('product/edit',compact('post','category','checked','meta'));

          }
          return redirect()->route('product.index')->with('msg', "sản phẩm không tồn tại"); 
    }

    public function productEditSave($id,Request $request){
   

        $updatePost = Post::where('ID',$id); 
               
        // $this->PostRepo->update($id,$updatePost);
        if($updatePost){             
             $updatePost->update([
                'post_title' => $request->post_title,
                'post_excerpt' =>  $request->post_excerpt,
                'post_content' =>  $request->post_content,
             ]);
        }
        $categoryTerm = TermRelationships::select('term_taxonomy_id')->where('object_id',$id)->get()->toArray();
        
        $cateOld = [];
        $category = $request->category;     
        //dd($categoryTerm);    
        foreach ($categoryTerm as $key => $value) {        
            $term_taxonomy_id = (String)$value['term_taxonomy_id'];
            array_push($cateOld,$term_taxonomy_id);
            if(!in_array($term_taxonomy_id,$category)){
                // xoa category
                //dd($term_taxonomy_id);                
                $termRelationships= TermRelationships::where('term_taxonomy_id',$term_taxonomy_id);
                $termRelationships->delete();

            }
        }        
        
        foreach ($category as $value) {
            if (!in_array($value, $cateOld)) {        
                 // thêm mới category
                    $result = new TermRelationships();
                    $result->object_id = $id;
                    $result->term_taxonomy_id = $value;
                    $result->term_order = 0;
                    $result->save();
            }
        }       
        
        if($request->thumnail[0]){ 
            $postMeta = PostMeta::where('post_id',$id)->where('meta_key','_thumbnail_id');
            if($postMeta){                                          
                $postMeta->update([
                    'meta_value' => $request->thumnail[0]
                ]);
            }
        }  

        if($request->_price){ 
            $postMeta = PostMeta::where('post_id',$id)->where('meta_key','_price');
            if($postMeta){                                          
                $postMeta->update([
                    'meta_value' => $request->_price
                ]);
            }
        }  

        if($request->_regular_price){ 
            $postMeta = PostMeta::where('post_id',$id)->where('meta_key','_regular_price');
            if($postMeta){                                          
                $postMeta->update([
                    'meta_value' => $request->_regular_price
                ]);
            }
        }  

        
        
        

        return redirect()->route('product.index')->with('msg', "Đã cập nhật sản phẩm thành công"); 
    }

    public function productDelete($id)
    {    
          $TermRelationships = TermRelationships::select('term_taxonomy_id')->where('object_id',$id)->get(); 
          //$termRelationships->delete();  
          if($TermRelationships->count() > 0 ){
            foreach ($TermRelationships as $value) {
                $termTemp= TermRelationships::where('term_taxonomy_id',$value->term_taxonomy_id);
                $termTemp->delete();
            }
          }
          $postMeta = PostMeta::where('post_id',$id);
          if($postMeta->count() > 0){
            $postMeta->delete(); 
          }
          $post = Post::where('ID',$id);
          if($post->count() > 0){
             $post->delete();              
             return redirect()->route('product.index')->with('msg', "Đã xóa sản phẩm thành công"); 
          }
          
          return redirect()->route('product.index')->with('msg', "sản phẩm không tồn tại"); 
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