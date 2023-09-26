<?php

namespace Modules\Post\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Post\Models\Post;

class PostController extends Controller
{  
    public function __construct()
    {
       // $this->middleware("auth");
    }
    public function index()    {
        
        return [
            'status' => 200
        ];
    }
}