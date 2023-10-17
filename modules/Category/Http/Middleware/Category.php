<?php
namespace Modules\Category\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Category
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Category</h2>";
        return $next($request);
    }
}
