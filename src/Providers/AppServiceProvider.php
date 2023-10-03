<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->singleton('app', function(Application $app){
            return $app::getInstance();
        });
    }

}