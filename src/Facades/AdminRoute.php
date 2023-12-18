<?php 
namespace Abrz\WPDF\Facades;

use Abrz\WPDF\Include\Facade;

class AdminRoute extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return 'route.admin';   
    }

}