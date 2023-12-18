<?php 
namespace Abrz\WPDF\Services\Route;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Enums\RouteHttpMethodEnum;
use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;

abstract class Route
{

    protected string $path;

    protected RouteScopeEnum $scope = RouteScopeEnum::WEB;

    protected RouteHttpMethodEnum $method = RouteHttpMethodEnum::GET;

    protected $controller;

    protected $function;

    protected $middleware = [];

    protected $name = '';

    public static function addToCollector(RouteContract $route)
    {
        $collector = RouteCollector::getInstance();
        $collector->addRoute($route);
        return $route;
    }
 
    public function controller(array $controller)
    {
        $this->controller = $controller[0];
        $this->function = $controller[1];
        return $this;
    }

    public function middleware(...$middleware)
    {
        if(!$middleware) return;
        $this->middleware = array_merge($this->middleware, $middleware);
        return $this;
    }

    public function scope(RouteScopeEnum $scope)
    {
        $this->scope = $scope;
        return $this;
    }

    public function method(RouteHttpMethodEnum $method = RouteHttpMethodEnum::GET)
    {
        $this->method = $method;
        return $this;
    }

    public function path(string $path)
    {
        $this->path = $path;
        return $this;
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }


}