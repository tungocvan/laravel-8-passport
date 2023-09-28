<?php
namespace Modules\Upload\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Upload
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Upload</h2>";
        return $next($request);
    }
}
