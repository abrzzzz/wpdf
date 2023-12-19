<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use WP_CLI;

class CLIServiceProvider extends ServiceProvider
{
    /**
     * Register CLI service.
     *
     * @return void
     */
    public function register() : void 
    {
        $this->app->singleton('cli', function(Application $app){
            return  new WP_CLI();
        });
    }

}