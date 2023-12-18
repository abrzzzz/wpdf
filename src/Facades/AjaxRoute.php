<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class AjaxRoute extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "route.ajax";   
    }

}