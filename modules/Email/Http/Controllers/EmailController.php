<?php

namespace Modules\Email\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Email\Models\Email;

class EmailController extends Controller
{  
    public function __construct()
    {
       // $this->middleware("auth");
    }
    public function index()
    {
        $title='Email View index.blade.php';
        return view('Email::index',compact('title'));
    }
}