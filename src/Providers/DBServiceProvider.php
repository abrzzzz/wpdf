<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\DB;
use Illuminate\Support\ServiceProvider;

class DBServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->bind('db', function(Application $app){
            return new DB();
        });
    }

}