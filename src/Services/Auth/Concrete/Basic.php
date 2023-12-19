<?php 
namespace Abrz\WPDF\Services\Auth\Concrete;

use Abrz\WPDF\Services\Auth\Auth;
use Abrz\WPDF\Services\Auth\Contracts\AuthContract;
use App\Models\User;

class Basic extends Auth implements AuthContract
{

    /**
     * 
     *
     * @param array $credentials
     * @return boolean
     */
    public function register(array $credentials) : bool
    {
        return wp_insert_user($credentials);
    }

    public function login(array $credentials) : self
    {
        wp_signon($credentials);
        return $this;
    }

    public function logout() : self
    {
        wp_logout();
        return $this;
    }

    public function validate() : bool
    {
        return false;
    }

    public function current() : User
    {
        return User::find(get_current_user_id());
    }

}