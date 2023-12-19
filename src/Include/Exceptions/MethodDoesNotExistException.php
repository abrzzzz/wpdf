<?php 
namespace Abrz\WPDF\Include\Exceptions;

use Exception;
use Throwable;

class MethodDoesNotExistException extends Exception
{

    // Redefine the exception so message isn't optional
    public function __construct(
        public $method = null,
        public $class = null, 
        $code = 0, 
        Throwable $previous = null
    ) {


        // make sure everything is assigned properly
        parent::__construct( __($this->message(), 'wpwf'), $code, $previous);
    }

    private function message()
    {
        return "Method " . $this->method . " doesn't exist in calss " . $this->class;
    }

}