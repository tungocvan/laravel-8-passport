<?php
namespace Modules\Post\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Post
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Post</h2>";
        return $next($request);
    }
}
