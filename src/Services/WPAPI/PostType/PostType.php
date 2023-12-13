<?php 
namespace Abrz\WPDF\Services\WPAPI\PostType;

use Abrz\WPDF\Contracts\HookContract;

class PostType implements HookContract
{

    private $id;

    private $name;

    private $singularName;

    private $isPublic = false;

    private $hasArchive = false;
    
    private $slug;


    public function register()
    {
        add_action('init', function()
        {
            register_post_type( $this->id,
                array(
                    'labels'      => array(
                        'name'          => __( $this->name, 'textdomain' ),
                        'singular_name' => __( $this->singularName, 'textdomain' ),
                    ),
                    'public'      => $this->isPublic,
                    'has_archive' => $this->hasArchive,
                    'rewrite'     => array( 
                        'slug' => $this->slug ?? $this->id 
                    ),
                )
	        );
        });


    }

    public function id(string $id)
    {
        $this->id = $id;
        return $this;
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }   

    public function singularName(string $singularName)
    {
        $this->singularName = $singularName;
        return $this;
    }

    public function isPublic()
    {
        $this->isPublic = true;
        return $this;
    }

    public function hasArchive()
    {
        $this->hasArchive = true;
        return $this;
    }

    public function slug(string $slug)
    {
        $this->slug = $slug;
        return $this;
    }



}