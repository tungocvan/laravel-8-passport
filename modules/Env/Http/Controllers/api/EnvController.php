<?php

namespace Modules\Env\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Env\Models\Env;

class EnvController extends Controller
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