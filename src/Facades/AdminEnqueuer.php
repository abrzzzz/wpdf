<?php 
namespace Abrz\WPDF\Facades;

use Illuminate\Support\Facades\Facade;

class AdminEnqueuer extends Facade
{

    protected static function getFacadeAccessor() : string 
    {
        return "admin_enqueuer";   
    }

}