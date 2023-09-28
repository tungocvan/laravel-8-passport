<?php
namespace Modules\Socialite\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Socialite
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Socialite</h2>";
        return $next($request);
    }
}
