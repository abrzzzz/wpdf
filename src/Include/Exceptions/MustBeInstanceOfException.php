<?php 
namespace Abrz\WPDF\Include\Exceptions;

use Exception;
use Throwable;

class MustBeInstanceOfException extends Exception
{

    // Redefine the exception so message isn't optional
    public function __construct(
        $source,
        $mustBe,
        $code = 0, 
        Throwable $previous = null
    ) {

        $message = "$source must be instance of $mustBe";

        parent::__construct( __($message, 'wpwf'), $code, $previous);
    }


}