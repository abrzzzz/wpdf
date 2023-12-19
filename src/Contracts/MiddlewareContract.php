<?php
namespace Abrz\WPDF\Contracts;

use Closure;
use Illuminate\Http\Request;

interface MiddlewareContract
{
    
    /**
     * Execute logic of middleware
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next);

}