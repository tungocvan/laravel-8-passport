<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Post\Models\Post;
use Modules\Post\Models\PostMeta;
use Modules\Category\Models\Terms;
use Modules\Post\Repositories\PostRepository;
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
        $Post = new PostRepository();
        
        $allPost = $Post->getPaginate(3);
        $posts = [];
        // dd($allPost[13]->postMeta[0]->post_id);
        foreach ($allPost as $key => $post) {                                 
            if($post->postMeta->count() > 0){              
                if($post->postMeta[0]->meta_key == '_thumbnail_id'){
                    $image = $post->postMeta[0]->meta_value;
                }                
            }            

            $TermRelationships = TermRelationships::select('term_taxonomy_id')->where('object_id',$post->ID)->get();   
            //dd($TermRelationships);
            $category = [];
            foreach ($TermRelationships as $key => $value) {                
                $cateSlug = Terms::select('term_id','slug')->where('term_id',$value->term_taxonomy_id)->first();                                 
                array_push($category,$cateSlug);
                
            }
            $itemPost = [
                'ID' => $post->ID,
                'title' => $post->post_title,  
                'image' => $image ?? '',
                'category' => $category            
            ];
            
            array_push($posts,$itemPost);
        }
//        dd($posts);
        return getUrlView('post',compact('allPost'));
    }
    public function add()
    {    
        $category = Terms::all(); 
        return getUrlView('post/add',compact('category'));    
    }
   
    public function postAdd(Request $request)
    {    
       
        $newPost = new Post;
        $newPost->post_title = $request->title;
        $newPost->post_content = $request->editor1;
        $newPost->post_status = 'publish';      
        $newPost->post_type = 'post';
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

        return redirect()->route('post.index')->with('msg', "Đã thêm bài viết thành công");  
    }

    public function postDelete($id)
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
             return redirect()->route('post.index')->with('msg', "Đã xóa bài viết thành công"); 
          }
          
          return redirect()->route('post.index')->with('msg', "bài viết không tồn tại"); 
    }
    public function postEdit($id)
    {    
         // dd($id);
          //dd(getCategoriesByIdPost($id));          
          $post = Post::where('ID',$id)->first();          
          if($post){
                $checked=[];
                foreach (getCategoriesByIdPost($id) as $item) {
                    array_push($checked,$item->term_id);
                }
                $postMeta = PostMeta::where('post_id',$id)->where('meta_key','_thumbnail_id')->first();
                if($postMeta){
                    //dd($postMeta->meta_value);
                    $post->avatar = $postMeta->meta_value;
                }
                
                
                $category = Terms::all();
               return getUrlView('post/edit',compact('post','category','checked'));

          }
          return redirect()->route('post.index')->with('msg', "bài viết không tồn tại"); 
    }

    public function postEditSave($id,Request $request){
        //dd($request);
        $updatePost = Post::where('ID',$id); 
               
        // $this->PostRepo->update($id,$updatePost);
        if($updatePost){             
             $updatePost->update([
                'post_title' => $request->title,
                'post_content' =>  $request->editor
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
            // $postMeta = new PostMeta;
            // $postMeta->post_id = $id;
            // $postMeta->meta_key = '_thumbnail_id';
            // $postMeta->meta_value = $request->thumnail[0];
            // $postMeta->save();
            $postMeta = PostMeta::where('post_id',$id)->where('meta_key','_thumbnail_id');
            if($postMeta){          
                //dd($request);                      
                $postMeta->update([
                    'meta_value' => $request->thumnail[0]
                ]);
            }
            

        }  

        return redirect()->route('post.index')->with('msg', "Đã cập nhật bài viết thành công"); 
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
    public function postCategoryDelete($id){     
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
        
        
        
        return redirect()->route('post.category')->with('msg', "Xóa chuyên mục thành công");
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