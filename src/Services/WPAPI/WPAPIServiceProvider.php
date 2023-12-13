<?php 
namespace Abrz\WPDF\Services\WPAPI;

use Abrz\WPDF\Foundation\Application;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class WPAPIServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->bind('wpapi', function(Application $app){
           return new WPAPI();
        });

    }

    public function boot(Dispatcher $events)
    {

    }


}