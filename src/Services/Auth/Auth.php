<?php
namespace Abrz\WPDF\Services\Auth;

use Abrz\WPDF\Include\Exceptions\ConfigNullGivenKeyException;

class Auth
{

    private $driver = 'basic';

    private $concrete = null;


    public function driver(string $driver = 'basic')
    {
        $this->driver = $driver;
        return $this->concrete();
    }

    private function concrete()
    {
        if(!app('config')->has("auth.drivers.$this->driver.class")) throw new ConfigNullGivenKeyException();
        $concrete = config("auth.drivers.$this->driver.class");
        $this->concrete = new $concrete();
        return $this->concrete;
    }


}