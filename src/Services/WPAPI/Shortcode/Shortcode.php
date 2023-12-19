<?php 
namespace Abrz\WPDF\Services\WPAPI\Shortcode;

use Abrz\WPDF\Contracts\HookContract;
use Closure;

class Shortcode implements HookContract
{

    /**
     * $tag
     *
     * @var string
     */
    private string $tag;

    /**
     * $callback
     *
     * @var Closure|string
     */
    private Closure|string $callback;

    /**
     * Register shortcode
     *
     * @return void
     */
    public function register()
    {

        add_shortcode($this->tag, function(){
            return app()->call($this->callback);;
        });

    }

    /**
     * set $tag
     *
     * @param string $tag
     * @return self
     */
    public function tag( string $tag ) : self
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * set $callback
     *
     * @param Closure|string $callback
     * @return self
     */
    public function callback( Closure|string $callback ) : self
    {
        $this->callback =  $callback;
        return $this;
    }


}