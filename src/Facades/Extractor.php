<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class Extractor extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "extractor";   
    }

}