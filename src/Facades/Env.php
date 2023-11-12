<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class Env extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "env";   
    }

}