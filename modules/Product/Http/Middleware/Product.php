<?php
namespace Modules\Product\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Product
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Product</h2>";
        return $next($request);
    }
}
