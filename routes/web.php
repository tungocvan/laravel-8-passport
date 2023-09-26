<?php
use League\Uri\Http;
use Illuminate\Support\Str;
use App\Jobs\ProcessPodcast;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Luigel\LaravelPassportViews\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {      
    return view('hamada.hamada');
});
// Route::get('/redirect', function (Request $request) {    
//     $request->session()->put('state', $state = Str::random(40)); 
//     $query = http_build_query([
//         'client_id' => env('TNV_CLIENT_ID'),
//         'redirect_uri' => url(env('TNV_CALLBACK_URL')),
//         'response_type' => 'code',
//         'scope' => '',
//         'state' => $state      
//     ]);
    
//     return redirect('https://app.tungocvan.app/oauth/authorize?'.$query);
//     // return 'oki';
// });

// Route::get('/callback', function (Request $request) {
    
//     //dd($request);
//     if($request->code){
//         $code = $request->code;
//         $state = $request->session()->pull('state');
//         $response = Http::asForm()->post('https://app.tungocvan.app/oauth/token', [
//             'grant_type' => 'authorization_code',
//             'client_id' => env('TNV_CLIENT_ID'),
//             'client_secret' => env('TNV_CLIENT_SECRET'),
//             'redirect_uri' => env('TNV_CALLBACK_URL'),            
//             'code' => $request->code,
//         ]);
//         $response = $response->json();
//         if(!empty($response['access_token'])){
//             $accessToken = $response['token'];
//             $user = Http::withHeaders([
//                 'Authorization' => 'Bear '.$accessToken,
//             ])->get('https://app.tungocvan.app/api/user');
//             dd($user->json());
//         }
//     }
    
    
// });
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test/{name}', function ($name) {
    $jobs = [
        'name' => $name,
        'status' => 200
    ];
    //ProcessPodcast::dispatch($jobs)->afterResponse();
    ProcessPodcast::dispatch($jobs)->delay(now()->addMinutes(1));
    return 'oki';
});
Route::get('/testLogin', function () {   
    echo env('DB_HOST');
    return view('auth.test-login');
});
Route::post('/testLogin', function (UserRequest $request) {   
    
})->name('test-login');

Route::get('/auth/google',[LoginController::class, 'google'])->name('auth.google');

Route::get('/auth/google/callback', [LoginController::class, 'googleCallback']);

Route::get('/auth/facebook', [LoginController::class, 'facebook'])->name('auth.facebook');

 Route::get('/auth/facebook/callback', [LoginController::class, 'facebookCallback']);

 Route::get('/apps',[ClientController::class, 'index'])->name('auth.apps')->middleware('auth');

