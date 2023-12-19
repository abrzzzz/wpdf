<?php 
namespace Abrz\WPDF\Services\WPAPI\Metabox;

use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Facades\WPAPI;
use Abrz\WPDF\Services\WPAPI\Metabox\Enum\MetaboxContextEnum;
use Abrz\WPDF\Services\WPAPI\Metabox\Enum\MetaboxPriorityEnum;
use Closure;

class Metabox implements HookContract
{

    /**
     * $id
     *
     * @var string
     */
    private string $id;

    /**
     * $title
     *
     * @var string
     */
    private string $title;

    /**
     * $screens
     *
     * @var array
     */
    private array $screens;

    /**
     * $callback
     *
     * @var string|Closure
     */
    private string|Closure $callback;

    /**
     * $metaKey
     *
     * @var string
     */
    private string $metaKey;

    /**
     * $postKey
     *
     * @var string
     */
    private string $postKey;

    /**
     * $context
     *
     * @var string|MetaboxContextEnum
     */
    private string|MetaboxContextEnum $context = MetaboxContextEnum::ADVANCES;
    
    /**
     * $priority
     *
     * @var string|MetaboxPriorityEnum
     */
    private string|MetaboxPriorityEnum $priority = MetaboxPriorityEnum::DEFAULT;

    /**
     * $args
     *
     * @var array
     */
    private array $args = [];

    /**
     * Register metabox
     *
     * @return void
     */
    public function register()
    {
        
        add_action( 'add_meta_boxes', function()
        {
            foreach ( $this->screens as $screen ) 
            {
                add_meta_box(
                    $this->id,  
                    $this->title, 
                    function($post, $props){
                        app()->call($this->callback, ['post' => $post, 'args' => $props['args']]);
                    },   
                    $screen, 
                    $this->context,
                    $this->priority,
                    $this->args
                );
            }    
        } );

        add_action( 'save_post', function($post_id)
        {
            if ( array_key_exists( $this->postKey, $_POST ) ) {
                update_post_meta(
                    $post_id,
                    $this->metaKey,
                    $_POST[$this->postKey]
                );
            }
        } );
    }

    /**
     * set $id
     *
     * @param string $id
     * @return self
     */
    public function id(string $id) : self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * set $title
     *
     * @param string $title
     * @return self
     */
    public function title(string $title) : self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * set $screens
     *
     * @param [type] ...$screen
     * @return self
     */
    public function screen(...$screen) : self
    {
        $this->screens = $screen;
        return $this;
    }

    /**
     * set $callback
     *
     * @param string|Closure $callback
     * @return self
     */
    public function callback(string|Closure $callback) : self
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * set $context
     *
     * @param string|MetaboxContextEnum $context
     * @return self
     */
    public function context(string|MetaboxContextEnum $context) : self
    { 
        $this->context = $context;
        return $this;
    }

    /**
     * set $priority
     *
     * @param string|MetaboxPriorityEnum $priority
     * @return self
     */
    public function priority(string|MetaboxPriorityEnum $priority) : self
    { 
        $this->priority = $priority;
        return $this;
    }

    /**
     * set $args
     *
     * @param array $args
     * @return self
     */
    public function args(array $args) : self
    { 
        $this->args = $args;
        return $this;
    }

    /**
     * set $metaKey
     *
     * @param string $metaKey
     * @return self
     */
    public function metaKey(string $metaKey) : self
    {
        $this->metaKey = $metaKey;
        return $this;
    }

    /**
     * set $postKey
     *
     * @param string $postKey
     * @return self
     */
    public function postKey(string $postKey) : self
    {
        $this->postKey = $postKey;
        return $this;
    }

    /**
     * Remove the meta box.
     *
     * @return void
     */
    public function remove() : void
    {
        remove_meta_box( $this->id, $this->screens, $this->context);
    }



}