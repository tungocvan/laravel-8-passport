<?php
namespace Modules\Admin\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Admin
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Admin</h2>";
        return $next($request);
    }
}
