<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\Migration;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->singleton('migration', function(Application $app){
            return  new Migration();
        });
    }

    public function boot()
    {
        
    }


}