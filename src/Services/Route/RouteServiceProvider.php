<?php 
namespace Abrz\WPDF\Services\Route;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\Route\Concretes\AdminRoute;
use Abrz\WPDF\Services\Route\Concretes\AjaxRoute;
use Abrz\WPDF\Services\Route\Concretes\RestRoute;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
   
    /**
     * Register All Routes service.
     *
     * @return void
     */
    public function register() : void 
    {
        // admin route
        $this->app->bind('route.admin', function(Application $app)
        {
            return new AdminRoute;
        });

        // ajax route
        $this->app->bind('route.ajax', function(Application $app)
        {
            return new AjaxRoute();
        });

        // rest route
        $this->app->bind('route.rest', function(Application $app)
        {
            return new RestRoute();
        });

    }

    /**
     * Bootstrap route application service
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {

    }

}