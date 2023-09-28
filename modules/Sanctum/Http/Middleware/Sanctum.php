<?php
namespace Modules\Sanctum\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Sanctum
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Sanctum</h2>";
        return $next($request);
    }
}
