<?php
namespace Abrz\WPDF\Contracts;

use Closure;
use Illuminate\Http\Request;

interface MiddlewareContract
{

    public function handle(Request $request, Closure $next);

}