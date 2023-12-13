<?php 
namespace Abrz\WPDF\Services\WPAPI\Metabox;

use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Facades\WPAPI;
use Abrz\WPDF\Services\WPAPI\Metabox\Enum\MetaboxContextEnum;
use Abrz\WPDF\Services\WPAPI\Metabox\Enum\MetaboxPriorityEnum;
use Closure;

class Metabox implements HookContract
{

    private string $id;

    private string $title;

    private array $screens;

    private string|Closure $callback;

    private string $metaKey;

    private string $postKey;

    private string|MetaboxContextEnum $context = MetaboxContextEnum::ADVANCES;
    
    private string|MetaboxPriorityEnum $priority = MetaboxPriorityEnum::DEFAULT;

    private array $args = [];

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

    public function id(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function screen(...$screen)
    {
        $this->screens = $screen;
        return $this;
    }

    public function callback(string|Closure $callback)
    {
        $this->callback = $callback;
        return $this;
    }

    public function context(string|MetaboxContextEnum $context)
    { 
        $this->context = $context;
        return $this;
    }

    public function priority(string|MetaboxPriorityEnum $priority)
    { 
        $this->priority = $priority;
        return $this;
    }

    public function args(array $args)
    { 
        $this->args = $args;
        return $this;
    }

    public function metaKey(string $metaKey)
    {
        $this->metaKey = $metaKey;
        return $this;
    }

    public function postKey(string $postKey)
    {
        $this->postKey = $postKey;
        return $this;
    }

    public function remove()
    {
        remove_meta_box( $this->id, $this->screens, $this->context);
    }



}