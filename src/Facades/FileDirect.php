<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class FileDirect extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "wp.file.direct";   
    }

}