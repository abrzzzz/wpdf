<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;
use Abrz\WPDF\Services\Route\Route;

class AdminRoute extends Route implements RouteContract
{

    private string $pageTitle = 'Page Title';

    private string $menuTitle = 'Menu Title';

    private string $capability = 'manage_options';
    
    private string $icon = '';

    private AdminRoute|null $parent = null;


    public function __construct()
    {
        $this->scope(RouteScopeEnum::ADMIN) 
        ->addToCollector($this);
    }

    public function register()
    {
        add_action('admin_menu', [$this, 'wpRegisterAdminRoute']);
    }

    public function parent(AdminRoute $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    public function capability(string $capability)
    {
        $this->capability = $capability;
        return $this;
    }

    public function menuTitle(string $menuTitle)
    {
        $this->menuTitle = $menuTitle;
        return $this;
    }

    public function pageTitle(string $pageTitle)
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }

    public function icon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function wpRegisterAdminRoute()
    {
        if(!$this->parent){
            add_menu_page(
                __( $this->pageTitle, 'textdomain' ),
                __( $this->menuTitle, 'textdomain' ),
                $this->capability,
                $this->path,
                function() {
                    $controller = app($this->controller)->middleware($this->middleware);
                    return $controller->callAction(
                        $this->function, 
                        [1]
                    );
                },
                $this->icon,
                6
            );
        }
        else
        {
            add_submenu_page(
                $this->parent->path, 
                __( $this->pageTitle, 'textdomain' ),
                __( $this->menuTitle, 'textdomain' ),
                $this->capability,
                $this->path, 
                function() {
                    $controller = app($this->controller)->middleware($this->middleware);
                    return $controller->callAction($this->function, ['test']);
                }, 
            );
        }
      
    }
    

}