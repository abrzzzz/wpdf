<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class WPAPI extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "wpapi";   
    }

}