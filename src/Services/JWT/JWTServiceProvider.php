<?php 
namespace Abrz\WPDF\Services\JWT;

use Abrz\WPDF\Foundation\Application;
use Abrz\WPDF\Services\JWT\Concrete\JWT;
use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        $this->app->bind('JWT', function(Application $app){
           return new JWT();
        });
    }

}