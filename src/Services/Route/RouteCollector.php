<?php 
namespace Abrz\WPDF\Services\Route;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Illuminate\Support\Collection;

class RouteCollector
{

    private static $instance;

    private Collection $routes;

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self;
            self::$instance->routes = collect([]);
        }
        return self::$instance;
    }
    
    public static function make()
    {
        self::getInstance()->getRoutes()
        ->each(function($route) {
            $route->register();
        });
    }
    
    public function addRoute(RouteContract $route) : void
    {
        $this->routes->add($route);
    }

    public function getRoutes()
    {
        return $this->routes;
    }


}