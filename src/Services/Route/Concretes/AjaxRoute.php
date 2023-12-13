<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Route;
use \Illuminate\Support\Str;

class AjaxRoute extends Route implements RouteContract
{

    private $action = "";
 
    public function register()
    {
        add_action( "wp_ajax_{$this->getAction()}", [$this, 'wpResgisterAjaxRoute'] );
    }

    public function wpResgisterAjaxRoute()
    {
        $controller = app($this->controller)->middleware($this->middleware);
        return $controller->callAction($this->function, [1]);
    }

    public function action(string $action)
    { 
        $this->action = $action;
        return $this;
    }

    public function getAction()
    {
        if(!$this->action && !$this->name){
            $this->action = Str::random(10);
        }
        return $this->action ?? $this->name;
    }

}