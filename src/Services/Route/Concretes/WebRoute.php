<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Route;

class WebRoute extends Route implements RouteContract
{
 
    public function register()
    {
        $this->wpResgisterWebRoute();
    }

    private function wpResgisterWebRoute()
    {
        return true;
    }

}