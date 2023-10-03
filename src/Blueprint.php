<?php 
namespace Abrz\WPDF;

use Abrz\WPDF\Facades\DB;

class Blueprint
{

    function __invoke() 
    {
        return DB::boot();
    }

}