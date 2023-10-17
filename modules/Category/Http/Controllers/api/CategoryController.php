<?php

namespace Modules\Category\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Category\Models\Category;

class CategoryController extends Controller
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