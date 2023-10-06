<?php
namespace Modules\Modules\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Modules
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Modules</h2>";
        return $next($request);
    }
}
