<?php
namespace Abrz\WPDF\Contracts;

interface HookContract
{

    /**
     * Register All hooks here e.g: actions, filters 
     *
     * @return void
     */
    public function register();

}