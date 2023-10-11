<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class Migration extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "migration";   
    }

}