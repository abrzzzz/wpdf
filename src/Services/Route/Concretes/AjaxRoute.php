<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;
use Abrz\WPDF\Services\Route\Route;
use Abrz\WPDF\Services\Route\Traits\RouteCollectorTrait;
use \Illuminate\Support\Str;

class AjaxRoute extends Route implements RouteContract
{
    use RouteCollectorTrait;

    /**
     * route's action
     *
     * @var [type]
     */
    private $action;
 
    /**
     * Register the ajax route
     *
     * @return void
     */
    public function register()
    {
        add_action( "wp_ajax_{$this->getAction()}", [$this, 'wpResgisterAjaxRoute'] );
    }

    /**
     * Route scope
     *
     * @return RouteScopeEnum
     */
    public function scope() : RouteScopeEnum
    {
        return RouteScopeEnum::AJAX;
    }

    /**
     * register & call the controller's  ajax callback
     *
     * @return void
     */
    public function wpResgisterAjaxRoute()
    {
        $controller = app($this->controller)->middleware($this->middleware);
        return $controller->callAction($this->function, [1]);
    }

    /**
     * set ajax's action 
     *
     * @param string $action
     * @return void
     */
    public function action(string $action)
    { 
        $this->action = $action;
        return $this;
    }

    /**
     * get ajax's action
     *
     * @return string
     */
    public function getAction()
    {
        if(!$this->action && !$this->name){
            $this->action = Str::random(10);
        }
        return $this->action ?? $this->name;
    }

}