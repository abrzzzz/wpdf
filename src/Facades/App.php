<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class App extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "app";   
    }

}