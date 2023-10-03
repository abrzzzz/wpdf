<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class DB extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return 'db';    
    }

}