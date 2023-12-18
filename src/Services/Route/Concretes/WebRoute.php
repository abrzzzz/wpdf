<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;
use Abrz\WPDF\Services\Route\Route;

class WebRoute extends Route implements RouteContract
{

    public function __construct()
    {
        $this->scope(RouteScopeEnum::WEB)
        ->addToCollector($this);
    }
 
    public function register()
    {
        $this->wpResgisterWebRoute();
    }

    private function wpResgisterWebRoute()
    {
        return true;
    }

}