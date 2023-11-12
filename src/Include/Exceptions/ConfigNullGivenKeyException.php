<?php 
namespace Abrz\WPDF\Include\Exceptions;

use Exception;
use Throwable;

class ConfigNullGivenKeyException extends Exception
{

    // Redefine the exception so message isn't optional
    public function __construct(
        $message  = "The key given does'nt exist in the config.",
        $code = 0, 
        Throwable $previous = null
    ) {


        // make sure everything is assigned properly
        parent::__construct( __($message, 'wpwf'), $code, $previous);
    }


}