<?php 
namespace Abrz\WPDF\Services\Auth;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\Auth\Auth;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->bind('auth', function(Application $app){
           return (new Auth())->driver();
        });
    }

}