<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\Extractor;
use Illuminate\Support\ServiceProvider;

class ExtractorServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {

        $this->app->singleton('extractor', function(Application $app){
            return  Extractor::getInstance();
        });
    }

}