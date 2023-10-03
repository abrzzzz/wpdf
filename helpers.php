<?php

if( ! function_exists( '_wpdf' ) ) 
{
    function _wpdf()
    {
        return Abrz\WPDF\Foundation\Application::getInstance();
    }
}