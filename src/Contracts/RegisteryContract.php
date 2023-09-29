<?php 
namespace Abrz\WPDF\Contracts;

interface RegisteryContract
{

    public function add($key, $value) : bool;

    public function remove($key) : mixed;
    
}