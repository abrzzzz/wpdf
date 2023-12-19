<?php 
namespace Abrz\WPDF\Services\WPAPI\PostType;

use Abrz\WPDF\Contracts\HookContract;

class PostType implements HookContract
{

    /**
     * $id
     *
     * @var string
     */
    private string $id;

    /**
     * $name
     *
     * @var string
     */
    private string $name;

    /**
     * $singularName
     *
     * @var string
     */
    private string $singularName;

    /**
     * $isPublic
     *
     * @var boolean
     */
    private bool $isPublic = false;

    /**
     * $hasArchive
     *
     * @var boolean
     */
    private bool $hasArchive = false;
    
    /**
     * $slug
     *
     * @var string
     */
    private string $slug;

    /**
     * Register post type
     *
     * @return void
     */
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
     * set $name
     *
     * @param string $name
     * @return self
     */
    public function name(string $name) : self
    {
        $this->name = $name;
        return $this;
    }   

    /**
     * set $singularName
     *
     * @param string $singularName
     * @return self
     */
    public function singularName(string $singularName) : self
    {
        $this->singularName = $singularName;
        return $this;
    }

    /**
     * set $isPublic
     *
     * @return self
     */
    public function isPublic() : self
    {
        $this->isPublic = true;
        return $this;
    }

    /**
     * set $hasArchive
     *
     * @return self
     */
    public function hasArchive() : self
    {
        $this->hasArchive = true;
        return $this;
    }

    /**
     * set $slug
     *
     * @param string $slug
     * @return self
     */
    public function slug(string $slug) : self
    {
        $this->slug = $slug;
        return $this;
    }

}