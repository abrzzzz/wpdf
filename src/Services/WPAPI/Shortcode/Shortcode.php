<?php 
namespace Abrz\WPDF\Services\WPAPI\Shortcode;

use Abrz\WPDF\Contracts\HookContract;
use Closure;

class Shortcode implements HookContract
{

    private $tag;

    private Closure|string $callback;


    public function register()
    {

        add_shortcode($this->tag, function(){
            return app()->call($this->callback);;
        });

    }

    public function tag( string $tag )
    {
        $this->tag = $tag;
        return $this;
    }

    public function callback( Closure|string $callback )
    {
        $this->callback =  $callback;
        return $this;
    }


}