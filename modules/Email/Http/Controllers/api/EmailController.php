<?php

namespace Modules\Email\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Email\Models\Email;

class EmailController extends Controller
{  
    public function __construct()
    {
       // $this->middleware("auth");
    }
    public function index(Request $request){
        $options = $request->all();    
        $status = send_mail($options);
        return [
            'status' => $status
        ];
    }
}