<?php

namespace Modules\Admin\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Admin\Models\Admin;

class AdminController extends Controller
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