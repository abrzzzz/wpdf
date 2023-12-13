<?php 
namespace Abrz\WPDF\Services\Route\Middleware;

use Abrz\WPDF\Contracts\MiddlewareContract;
use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware implements MiddlewareContract
{

    public function handle(Request $request, Closure $next)
    {
        if(!is_super_admin()){
            wp_safe_redirect('/wp-admin');
            exit;
        }

        return $next($request);
    }
    
}