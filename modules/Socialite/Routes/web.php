<?php 
 use Illuminate\Support\Facades\Route;
 use Illuminate\Http\Request;
 use Modules\Socialite\Http\Controllers\SocialiteController;
 use App\Http\Controllers\Auth\LoginController;
 use Luigel\LaravelPassportViews\Http\Controllers\ClientController;
 
 
 Route::middleware(['web'])->prefix('/')->group(function(){
    Auth::routes();
    Route::get('/socialite', [SocialiteController::class, 'index'])->name('index');    
    Route::get('/auth/google',[LoginController::class, 'google'])->name('auth.google');
    Route::get('/auth/google/callback', [LoginController::class, 'googleCallback']);
    Route::get('/auth/facebook', [LoginController::class, 'facebook'])->name('auth.facebook');
    Route::get('/auth/facebook/callback', [LoginController::class, 'facebookCallback']);
    Route::get('/apps',[ClientController::class, 'index'])->name('auth.apps')->middleware('auth');    
    // Route::get('/redirect', function (Request $request) {    
    //     $clientId = config('services.tnv.client_id');
    //     $redirectUri = url(config('services.tnv.redirect_uri'));    
    //     $apiUrl = config('services.tnv.api_url');
    //     $request->session()->put('state', $state = Str::random(40)); 
    //     $query = http_build_query([
    //         'client_id' => $clientId,
    //         'redirect_uri' => $redirectUri,
    //         'response_type' => 'code',
    //         'scope' => '',
    //         'state' => $state      
    //     ]);
        
    //     return redirect($apiUrl."/oauth/authorize?".$query);
    //     //return 'oki';
    // });
    
    // Route::get('/auth/tnv/callback', function (Request $request) {
        
    //     //dd($request);
    //     $clientId = config('services.tnv.client_id');
    //     $clientSecret = config('services.tnv.client_secret');
    //     $redirectUri = url(config('services.tnv.redirect_uri')); 
    //     $apiUrl = config('services.tnv.api_url');
    //     if($request->code){
    //         $code = $request->code;
    //         $state = $request->session()->pull('state');
    //         $response = Http::asForm()->post(config('services.tnv.api_url').'/oauth/token', [
    //             'grant_type' => 'authorization_code',
    //             'client_id' => $clientId,
    //             'client_secret' => $clientSecret,
    //             'redirect_uri' => $redirectUri,            
    //             'code' => $code
    //         ]);
             
    //         $response = $response->json();
           
    //         if(!empty($response['access_token'])){
    //             $accessToken = $response['access_token'];            
    //             $user = Http::withHeaders([
    //                 'Authorization' => 'Bearer '.$accessToken,
    //             ])->get($apiUrl.'/api/user');
    //             //dd($user->json());
    //             return $user->json();
    //             //return redirect('/');
    //         }
    //     }    
    // });
    
    Route::get('auth/zalo',[LoginController::class, 'redirectToZalo'])->name('auth.zalo');
    Route::get('auth/zalo/callback',[LoginController::class, 'handleZaloCallback']);

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
