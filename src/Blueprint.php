<?php 
namespace Abrz\WPDF;

class Blueprint
{

    function __invoke() 
    {
        return DB::boot();
    }

}