<?php
namespace Modules\Option\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Option
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Option</h2>";
        return $next($request);
    }
}
