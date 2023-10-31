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
        
        $scripts = $this->app->make('config')->get('enqueue')['admin'];
        $enqueuer = $this->app->make('admin_enqueuer');
        $js = $scripts['js'];
        if($cjs = count($js))
        {
            for ($i=0; $i < $cjs; $i++) { 
                $enqueuer->js($js[$i]);
            }
        }

        $css = $scripts['css'];
        if($ccss = count($css))
        {
            for ($i=0; $i < $ccss; $i++) { 
                $enqueuer->css($css[$i]);
            }
        }

        $enqueuer->hooks();


    }

}