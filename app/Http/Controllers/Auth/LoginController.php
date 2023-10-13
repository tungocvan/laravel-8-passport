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
use Illuminate\Support\Facades\Http;
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
    protected $redirectTo = RouteServiceProvider::ADMIN;

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
            'password' => $request->password
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
            $user->phone = '0903971949';
            $user->provider = 'google';
            $user->password = Hash::make(rand());
            $user->group_id = 1;
            $user->username =$user->email;
            $user->status = 0;
            $avatar = $userGoogle->avatar ?? '';
            $user->avatar = $avatar;
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
        if (!$user) {            
            $user = new User();
            $user->name = $userFacebook->getName();
            $user->email = $userFacebook->getEmail();
            $user->provider_id = $userFacebook->getId();
            $user->provider = 'facebook';
            $user->phone = '0876445599';
            $user->password = Hash::make(rand());
            $user->group_id = 1;
            $user->username =$user->email;
            $avatar = $userFacebook->avatar ?? '';
            $user->avatar = $avatar;
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
        // https://oauth.zaloapp.com/v4/permission?app_id=3600784541564399611&code_challenge=MfCCb1qkUzL_H9TgLNQTi0XsJvOFtFrPp_EXFGe_t04&state=RfaNFQbN5YMDAkuv7mdMdmavXATMgvWqoer11Ei2
        $app_id= config('services.zalo.client_id');
        $redirect_uri= url(config('services.zalo.redirect_uri'));
        $codeVerifier = bin2hex(random_bytes(64));
        $request->session()->put('codeVerifier', $codeVerifier);
        $codeChallenge = $this->base64UrlEncode(hash('sha256', $codeVerifier, true));
        $state = Str::random(40);        
        $query = http_build_query([
            'app_id' => $app_id,
            'redirect_uri' => $redirect_uri,
            'code_challenge' => $codeChallenge,                        
            'state' => $state      
        ]);
        
        return redirect("https://oauth.zaloapp.com/v4/permission?".$query);
        
    }
    public function handleZaloCallback(Request $request)
    {
        
        
        $app_id= config('services.zalo.client_id');
        $client_secret= config('services.zalo.client_secret');
        $redirect_uri= url(config('services.zalo.redirect_uri'));
        $code = $request->code;
        $codeVerifier = $request->session()->pull('codeVerifier');
        $apiUrl = config('services.zalo.api_url');
        $response = Http::asForm()->withHeaders([
                "Content-Type" => "application/x-www-form-urlencoded",   
                'secret_key' => $client_secret,
            ])->post('https://oauth.zaloapp.com/v4/access_token', [
                        'code' => $code,
                        'app_id' => $app_id,  
                        'grant_type' => 'authorization_code',                        
                        'code_verifier' => $codeVerifier
            ]);
        $response = $response->json();      
        
        if(!empty($response['access_token'])){
            $accessToken = $response['access_token'];      
            $response = Http::withHeaders([
                'access_token' => $accessToken,
            ])->get('https://graph.zalo.me/v2.0/me?fields=id,name,picture');               
                   
            $userData = json_decode($response->getBody(), true);                
            $user  = User::where('provider_id', $userData['id'])->first();
            if (!$user) {            
                $user = new User();
                $user->name = $userData['name'];
                $user->email = $userData['id']."@gmail.com";
                $user->provider_id = $userData['id'];
                $user->provider = 'zalo';
                $user->password = Hash::make(rand());
                $user->group_id = 1;
                $avatar = $userData['picture']['data']['url'] ?? '';
                $user->avatar = $avatar;
                $user->username =$userData['id'];
                $user->save();
            }
            $userId = $user->id;
            Auth::loginUsingId($userId);
            return redirect($this->redirectTo);    
            //return redirect('/');
        }
        //dd($response->json());
        
    }
    function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

}
 