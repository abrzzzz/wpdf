<?php 
namespace Abrz\WPDF\Include\Controller;

abstract class BaseController
{

    private $middleware = [];

    public function middleware(array $middleware = [])
    {
        for ($i=0; $i < count($middleware); $i++) { 
            $this->middleware[] = $middleware[$i];
        }
        return $this;
    }

    public function getMiddleware()
    {
        if(!$this->middleware) return [];
        return $this->middleware;
    }

    public function callAction($closure, array $params = [])
    { 
        $class = get_called_class();
        $request = app('request');
        $next = function($request) use ($class, $closure, $params) {
            return app()->call("$class@$closure", ['data' => $params]);
        };

        $middlewares = $this->getMiddleware();
        if($middlewares)
        {
            foreach ($middlewares as $middleware) 
            {
                $next = function($request) use ($middleware, $next)
                {
                    return app($middleware)->handle($request, $next);
                };
                        
            }

        }

        return $next($request);

    }




}