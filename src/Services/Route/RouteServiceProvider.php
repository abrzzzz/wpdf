<?php 
namespace Abrz\WPDF\Services\Route;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\Route\Route;
use Abrz\WPDF\Services\Route\RouteCollector;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->bind('route', function(Application $app){
           return (new Route());
        });

    }

    public function boot(Dispatcher $events)
    {

    }


}