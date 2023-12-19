<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\Extractor;
use Illuminate\Support\ServiceProvider;

class ExtractorServiceProvider extends ServiceProvider
{
   
    /**
     * Register Extractor service.
     *
     * @return void
     */
    public function register() : void 
    {

        $this->app->singleton('extractor', function(Application $app){
            return  Extractor::getInstance();
        });
    }

}