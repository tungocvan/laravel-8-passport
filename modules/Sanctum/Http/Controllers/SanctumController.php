<?php

namespace Modules\Sanctum\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Sanctum\Models\Sanctum;

class SanctumController extends Controller
{  
    public function __construct()
    {
       // $this->middleware("auth");
    }
    public function index()
    {
        $title='Sanctum View index.blade.php';
        return view('Sanctum::index',compact('title'));
    }
}