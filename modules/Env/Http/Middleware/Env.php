<?php
namespace Modules\Env\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Env
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Env</h2>";
        return $next($request);
    }
}
