<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Post\Models\Post;
use Modules\Post\Repositories\PostRepositoryInterface;
// use Modules\Post\Repositories\PostRepository;
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
        dd($request->all());
        return getUrlView('post/add');    
    }
    public function category()
    {    
        return getUrlView('post/category');    
    }
    public function tags()
    {    
        return getUrlView('post/tags');    
    }
}