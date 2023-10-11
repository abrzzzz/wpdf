<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class CLI extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "cli";   
    }

}