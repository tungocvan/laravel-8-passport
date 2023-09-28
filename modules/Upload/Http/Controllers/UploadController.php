<?php

namespace Modules\Upload\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Upload\Models\Upload;

class UploadController extends Controller
{  
    public function __construct()
    {
       // $this->middleware("auth");
    }
    public function index()
    {
        $title='Upload View index.blade.php';
        return view('Upload::index',compact('title'));
    }
}