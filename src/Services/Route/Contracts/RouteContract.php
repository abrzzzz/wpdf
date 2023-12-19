<?php 
namespace Abrz\WPDF\Services\Route\Contracts;

use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;

interface RouteContract
{

    /**
     * Scope of the route
     *
     * @return RouteScopeEnum
     */
    public function scope() : RouteScopeEnum;

    /**
     * Register the route in wp
     *
     * @return void
     */
    public function register();

}