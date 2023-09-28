<?php

namespace Modules\Sanctum\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Sanctum\Models\Sanctum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class SanctumController extends Controller
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
    public function getUsers(Request $request)    {
        
        $users = User::all();
        return $users;
    }
    public function freshToken(Request $request)    {
        
        if($request->header('authorization')){
            $hashToken = $request->header('authorization');
            $hashToken = trim(str_replace('Bearer','',$hashToken));
            $token = PersonalAccessToken::findToken($hashToken);            
            if($token){
                $tokenCreated = $token->created_at;
                $expire = Carbon::parse($tokenCreated)->addMinutes(config('sanctum.expiration'));
                if(Carbon::now() >=$expire){
                    $userID = $token->tokenable_id;
                    $user = User::find($userID);
                    $user->tokens()->delete();
                    $newToken = $user->createToken('auth_token')->plainTextToken;
                    $response = [
                        'status' => 200,
                        'token' => $newToken
                    ];
                }else{
                    $response = [
                        'status' => 201,
                        'title' =>'Unexpire'
                    ];
                }            
                
            }
            }else{
                $response = [        
                    'status' => 400,        
                    'title' =>'No Token'
                ];
            }        
        return $response;
    }
    public function deleteToken(Request $request) {
        
        return $request->user()->currentAccessToken()->delete();
    }
    public function login(Request $request)    {
        $email = $request->email;
        $password = $request->password;
        $checkLogin = Auth::attempt(['email' => $email, 'password' => $password]);
        if($checkLogin){
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $response = [
                'status' => 200,
                'token' => $token
            ];
        }else{
            $response = [
                'status' => 401,
                'title' => 'Unauthorized'
            ];
        }
        
        return $response;
    }

}