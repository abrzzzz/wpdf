<?php 
namespace Abrz\WPDF\Services\Auth\Contracts;

interface AuthContract
{

    public function register(array $credentials) : bool;
    
    public function login(array $credentials) : self;

    public function logout() : self;
    
    public function validate() : bool;

}