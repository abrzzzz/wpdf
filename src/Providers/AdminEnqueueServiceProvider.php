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
        
        $enqueuer = $this->app->make('admin_enqueuer');
        $js =  config('enqueue.admin.js');
        if($cjs = count($js))
        {
            for ($i=0; $i < $cjs; $i++) { 
                $enqueuer->js($js[$i]);
            }
        }

        $css = config('enqueue.admin.css');
        if($ccss = count($css))
        {
            for ($i=0; $i < $ccss; $i++) { 
                $enqueuer->css($css[$i]);
            }
        }

    }

}