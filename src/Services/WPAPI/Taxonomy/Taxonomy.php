<?php 
namespace Abrz\WPDF\Services\WPAPI\Taxonomy;

use Abrz\WPDF\Contracts\HookContract;
use Illuminate\Support\Str;

class Taxonomy implements HookContract
{


    private $name;
    
    private $singularName;

    private $slug;

    private $isHirarchical = true;

    private $showUI = true;
    
    private $showAdminCol = true;

    private $queryVar = true;

    private $labels;

    private array $postTypes;


    public function register()
    {
       add_action( 'init', function(){
        $args   = array(
            'hierarchical'      => $this->isHirarchical, // make it hierarchical (like categories)
            'labels'            => $this->getLabels(),
            'show_ui'           => $this->showUI,
            'show_admin_column' => $this->showAdminCol,
            'query_var'         => $this->queryVar,
            'rewrite'           => [ 'slug' => $this->getSlug() ],
        );

        register_taxonomy( $this->name, $this->postTypes, $args );
       
    });
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

    public function slug(string $slug)
    {
        $this->slug = $slug;
        return $this;
    }



    public function labels(array $labels)
    {
        $this->labels = $labels;
        return $this;
    }

    public function postType(...$postType)
    {
        $this->postTypes = $postType;
        return $this;
    }

    public function isHirarchical(bool $isHirarchical = true)
    {
        $this->isHirarchical($isHirarchical);
        return $this;
    }

    public function showUI(bool $showUI = true)
    {
        $this->showUI = $showUI;
        return $this;
    }

    public function queryVar(bool $queryVar = true)
    {
        $this->queryVar = $queryVar;
        return $this;
    }

    public function showAdminCol(bool $showAdminCol = true)
    {
        $this->showAdminCol = $showAdminCol;
        return $this;
    }


    public function getName()
    {
        return Str::plural(
            Str::replace(['-', '_'], ' ', $this->name)
        );
    }

    public function getSingularName()
    {
        return $this->singularName ?? Str::singular(
            Str::replace(['-', '_'], ' ', $this->name)
        );
    }

    public function getSlug()
    {
        if($this->slug) return Str::slug($this->slug);
        return Str::slug($this->name);
    }

    private function getLabels()
    {
        if($this->labels) return $$this->labels;
        
        return [
            'name'              => _x( $this->getName(), 'taxonomy general name' ),
            'singular_name'     => _x( $this->getSingularName(), 'taxonomy singular name' ),
            'search_items'      => __( 'Search ' . $this->getName(), '' ),
            'all_items'         => __( 'All '. $this->getName(), '' ),
            'parent_item'       => __( 'Parent ' . $this->getSingularName() ),
            'parent_item_colon' => __( 'Parent ' . $this->getSingularName() . ' :', ''),
            'edit_item'         => __( 'Edit ' . $this->getSingularName(), '' ),
            'update_item'       => __( 'Update ' . $this->getSingularName(), ''),
            'add_new_item'      => __( 'Add New ' . $this->getSingularName(), '' ),
            'new_item_name'     => __( 'New ' . $this->getSingularName() . ' Name', '' ),
            'menu_name'         => __( $this->getSingularName() ),
        ];
    }


}