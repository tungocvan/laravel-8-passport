<?php

namespace Modules\Socialite\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Socialite\Models\Socialite;

class SocialiteController extends Controller
{  
    public function __construct()
    {
       // $this->middleware("auth");
    }
    public function index()
    {
        $title='Socialite View index.blade.php';
        return view('Socialite::index',compact('title'));
    }
}