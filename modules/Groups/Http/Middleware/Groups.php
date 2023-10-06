<?php
namespace Modules\Groups\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Groups
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Groups</h2>";
        return $next($request);
    }
}
