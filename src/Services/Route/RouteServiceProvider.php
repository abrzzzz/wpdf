<?php 
namespace Abrz\WPDF\Services\Route;

use Abrz\WPDF\Facades\AjaxRoute as FacadesAjaxRoute;
use Abrz\WPDF\Facades\WPAPI;
use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\Route\Concretes\AdminRoute;
use Abrz\WPDF\Services\Route\Concretes\AjaxRoute;
use Abrz\WPDF\Services\Route\Concretes\RestRoute;
use Abrz\WPDF\Services\Route\Enums\RouteHttpMethodEnum;
use App\Controllers\LogController;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {

        $this->app->bind('route.admin', function(Application $app)
        {
            return new AdminRoute;
        });

        $this->app->bind('route.ajax', function(Application $app)
        {
            return new AjaxRoute();
        });

        $this->app->bind('route.rest', function(Application $app)
        {
            return new RestRoute();
        });

    }

    public function boot(Dispatcher $events)
    {


    }


}