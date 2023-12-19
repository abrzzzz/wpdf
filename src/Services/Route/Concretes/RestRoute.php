<?php 
namespace Abrz\WPDF\Services\Route\Concretes;

use Abrz\WPDF\Services\Route\Contracts\RouteContract;
use Abrz\WPDF\Services\Route\Enums\RouteScopeEnum;
use Abrz\WPDF\Services\Route\Route;
use Abrz\WPDF\Services\Route\Traits\RouteCollectorTrait;
use WP_Error;

class RestRoute extends Route implements RouteContract
{

    use RouteCollectorTrait;

    /**
     * route's namespace
     *
     * @var string
     */
    private $namespace = '';

    /**
     * route's permission
     *
     * @var boolean
     */
    private $permission = true;

    /**
     * Register the rest endpoint
     *
     * @return void
     */
    public function register()
    {   
        add_action('rest_api_init', [$this, 'wpRegisterRestEndpoint']);
    }

    /**
     * Route scope
     *
     * @return RouteScopeEnum
     */
    public function scope() : RouteScopeEnum
    {
        return RouteScopeEnum::REST;
    }

    /**
     * endpoint's namespace
     *
     * @param string $namespace
     * @return self
     */
    public function namespace(string $namespace) : self
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * route's permission
     *
     * @param callable $permission
     * @return self
     */
    public function permission(callable $permission) : self
    {
        if(!$permission) $this->permission = true;
        $this->permission = call_user_func($permission);
        return $this;
    }

    /**
     * Execute the wp method: register_rest_route
     *
     * @return void
     */
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
            false
        );

    }
}