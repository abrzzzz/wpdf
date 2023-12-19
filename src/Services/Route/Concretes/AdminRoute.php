<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;
use Abrz\WPDF\Services\Route\Route;
use Abrz\WPDF\Services\Route\Traits\RouteCollectorTrait;

class AdminRoute extends Route implements RouteContract
{
    use RouteCollectorTrait;

    /**
     * Page's title 
     *
     * @var string
     */
    private string $pageTitle = 'Page Title';

    /**
     * Admin's menu title
     *
     * @var string
     */
    private string $menuTitle = 'Menu Title';

    /**
     * Admin page access capability
     *
     * @var string
     */
    private string $capability = 'manage_options';
    
    /**
     * Admin page menu's icon 
     *
     * @var string
     */
    private string $icon = '';

    /**
     * The parent of this page
     *
     * @var AdminRoute|null
     */
    private AdminRoute|null $parent = null;


    /**
     * Register the page
     *
     * @return void
     */
    public function register()
    {
        add_action('admin_menu', [$this, 'wpRegisterAdminRoute']);
    }

    /**
     * Route scope
     *
     * @return RouteScopeEnum
     */
    public function scope() : RouteScopeEnum
    {
        return RouteScopeEnum::ADMIN;
    }

    /**
     * set Parent of page
     *
     * @param AdminRoute $parent
     * @return void
     */
    public function parent(AdminRoute $parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * set capability of page
     *
     * @param string $capability
     * @return void
     */
    public function capability(string $capability)
    {
        $this->capability = $capability;
        return $this;
    }

    /**
     * set menuTitle of page
     *
     * @param string $menuTitle
     * @return void
     */
    public function menuTitle(string $menuTitle)
    {
        $this->menuTitle = $menuTitle;
        return $this;
    }

    /**
     * set pageTitle of page
     *
     * @param string $pageTitle
     * @return void
     */
    public function pageTitle(string $pageTitle)
    {
        $this->pageTitle = $pageTitle;
        return $this;
    }

    /**
     * set page icon
     *
     * @param string $icon
     * @return void
     */
    public function icon(string $icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * execution of wp function: add_menu_page|add_submenu_page 
     *
     * @return void
     */
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