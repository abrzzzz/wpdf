<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\AdminEnqueuer;
use Illuminate\Support\ServiceProvider;

class AdminEnqueueServiceProvider extends ServiceProvider
{

   
    public function register() : void 
    {
        
        $this->app->singleton('admin_enqueuer', function(Application $app){
            return  new AdminEnqueuer();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        


    }

}