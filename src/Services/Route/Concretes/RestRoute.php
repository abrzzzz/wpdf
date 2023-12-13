<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Route;
use WP_Error;

class RestRoute extends Route implements RouteContract
{

    private $namespace = '';

    private $permission = true;

    public function register()
    {   
        add_action('rest_api_init', [$this, 'wpRegisterRestEndpoint']);
    }

    public function namespace(string $namespace)
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function permission(callable $permission)
    {
        if(!$permission) $this->permission = true;
        $this->permission = call_user_func($permission);
        return $this;
    }

    public function wpRegisterRestEndpoint()
    {

        register_rest_route(
            $this->namespace, 
            $this->path, 
            [
            'methods'  => $this->method->value,
            'callback'  => function($data)
            {
                $controller = app($this->controller)->middleware($this->middleware);
                return $controller->callAction($this->function, $data->get_params());
            },
            'permission_callback'   => function()
                {
                    if(!$this->permission) return new WP_Error( 'rest_forbidden', esc_html__( "oops, You don't have access to this endpoint.", 'my-text-domain' ), array( 'status' => 401 ) );
                    return true;
                }
            ], 
            false);

    }
}