<?php 
namespace Abrz\WPDF\Services\Route;

use Abrz\WPDF\Contracts\MiddlewareContract;
use Abrz\WPDF\Include\Middleware\Middleware;
use Abrz\WPDF\Services\Route\Concretes\AdminRoute;
use Abrz\WPDF\Services\Route\Concretes\AjaxRoute;
use Abrz\WPDF\Services\Route\Concretes\RestRoute;
use Abrz\WPDF\Services\Route\Concretes\WebRoute;
use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Enums\RouteHttpMethodEnum;
use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;
use Illuminate\Support\Collection;

class Route
{

    protected string $path;

    protected RouteScopeEnum $scope = RouteScopeEnum::WEB;

    protected RouteHttpMethodEnum $method = RouteHttpMethodEnum::GET;

    protected $controller;

    protected $function;

    protected $middleware = [];

    protected $name = '';


    public function concrete(RouteContract $route)
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

    public function admin()
    {
        $route = new AdminRoute();
        $route->scope = RouteScopeEnum::ADMIN;
        return $this->concrete($route);
    }

    public function rest()
    {
        $route = new RestRoute();
        $route->scope = RouteScopeEnum::REST;
        return $this->concrete($route);

    }

    public function web()
    {
        $route = new WebRoute();
        $route->scope = RouteScopeEnum::WEB;
        return $this->concrete($route);

    }

    public function ajax()
    {
        $route = new AjaxRoute();
        $route->scope = RouteScopeEnum::AJAX;
        return $this->concrete($route);

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