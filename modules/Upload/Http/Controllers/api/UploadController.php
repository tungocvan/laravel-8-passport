<?php

namespace Modules\Upload\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Upload\Models\Upload;

class UploadController extends Controller
{  
    public function __construct()
    {
       // $this->middleware("auth");
    }
    public function index(Request $request)    {        
        if($request->hasFile('file')) {
            dd($request->all());
            return [
                'status' => 'Success'
            ];
        }
        return [
            'status' => 'Error'
        ];
    }
}
 