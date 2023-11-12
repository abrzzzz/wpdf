<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Facades\Env;
use Abrz\WPDF\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Dotenv\Dotenv;

class EnvServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->singleton('env', function(Application $app){
            return new Dotenv();
        });
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('env')->load(WPDF_PLUGIN_PATH.'/.env');
    }

}