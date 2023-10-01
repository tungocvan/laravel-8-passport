<?php
namespace Modules\Users\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Users
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Users</h2>";
        return $next($request);
    }
}
