<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function validateLogin(Request $request)
    {        
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string|min:3',
        ],[
            $this->username().'.required' => 'Tên đăng nhập không được bỏ trống.',
            $this->username().'.string' => 'Tên đăng nhập kiểu dữ liệu phải là chuỗi.',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.min' => 'Mật khẩu ít nhất :min ký tự',
        ]);
    }
    public function username()
    {
        return 'username';
    }
    protected function credentials(Request $request)
    {
        $fieldb = 'username';
        if(filter_var($request->username,FILTER_VALIDATE_EMAIL)){
            $fieldb = 'email';
        }
        $dataArr = [
            $fieldb => $request->username,
            'password' => $request->password,
            'status' => 0
        ];
        return $dataArr;
        //return $request->only($this->username(), 'password');
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu không hợp lệ'],
        ]);
    }



    public function googleCallback()
    {
        $userGoogle = Socialite::driver('google')->user();        
        $user  = User::where('email', $userGoogle->getEmail())->first();
        if(!$user){                     
            $user = new User();
            $user->name = $userGoogle->getName();
            $user->email = $userGoogle->getEmail();
            $user->provider_id = $userGoogle->getId();
            $user->provider = 'google';
            $user->password = Hash::make(rand());
            $user->group_id = 1;
            $user->username =$user->email;
            $user->status = 0;
            $user->save();            
        }
        $status =$user->status;
        // kiểm tra status
        $userId = $user->id;
        //dd($userGoogle);
        Auth::loginUsingId($userId);
        //Auth::login($user);
        //dd($user);
        return redirect($this->redirectTo);
    }
    public function google()
    {
        return Socialite::driver('google')->redirect();        
    }
    
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();        
    }
    
    public function facebookCallback()
    {
        $userFacebook = Socialite::driver('facebook')->user();
        $user  = User::where('email', $userFacebook->getEmail())->first();
        //dd($user);            
        if (!$user) {            
            $user = new User();
            $user->name = $userFacebook->getName();
            $user->email = $userFacebook->getEmail();
            $user->provider_id = $userFacebook->getId();
            $user->provider = 'facebook';
            $user->password = Hash::make(rand());
            $user->group_id = 1;
            $user->username =$user->email;
            $user->save();
        }
        $status =$user->status;
        // kiểm tra status
        $userId = $user->id;
        Auth::loginUsingId($userId);
        return redirect($this->redirectTo);
    }

    public function redirectToZalo(Request $request)
    {
        // https://oauth.zaloapp.com/v4/permission?app_id=<APP_ID>&redirect_uri=<CALLBACK_URL>&code_challenge=<CODE_CHALLENGE>&state=<STATE>
        
        $app_id= config('services.zalo.client_id');
        $redirect_uri= config('services.zalo.redirect');
        $codeVerifier = bin2hex(random_bytes(64));
        $codeChallenge = $this->base64UrlEncode(hash('sha256', $codeVerifier, true));
        $state = Str::random(40);
        
        $query = http_build_query([
            'app_id' => $app_id,
            'redirect_uri' => $redirect_uri,
            'code_challenge' => $codeChallenge,            
            'state' => $state      
        ]);
        //dd($query);
        return redirect("https://oauth.zaloapp.com/v4/permission?".$query);
        
    }
    public function handleZaloCallback(Request $request)
    {
        dd($request);
        // $user = Socialite::driver('zalo')->user();

        // // Thực hiện xử lý với thông tin người dùng ở đây
        // dd($user);
    }
    function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }


}
 