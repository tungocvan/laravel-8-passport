<?php
namespace Modules\Email\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Email
{
    public function handle(Request $request, Closure $next)
    {
        echo "<h2>middleware Email</h2>";
        return $next($request);
    }
}
