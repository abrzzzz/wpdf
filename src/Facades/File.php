<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class File extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "file";   
    }

}