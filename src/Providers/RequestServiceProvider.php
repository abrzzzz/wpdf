<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
   
    /**
     * Register request service.
     *
     * @return void
     */
    public function register() : void 
    {
        $this->app->singleton('request', function(Application $app){
            return Request::capture();
        });
    }

}