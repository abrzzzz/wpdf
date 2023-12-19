<?php 
namespace Abrz\WPDF\Services\WPAPI\Enqueuer;

use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Services\WPAPI\Enqueuer\Enum\EnqueuerScopeEnum;

class Enqueuer implements HookContract
{

    /**
     * $css
     *
     * @var array
     */
    private array $css = [];

    /**
     * $js
     *
     * @var array
     */
    private array $js = [];

    /**
     * $scope
     *
     * @var string|EnqueuerScopeEnum
     */
    private  string|EnqueuerScopeEnum $scope = EnqueuerScopeEnum::ADMIN;

    /**
     * Register the scripts
     *
     * @return void
     */
    public function register()
    {
        if($this->scope == EnqueuerScopeEnum::ADMIN)
        {
            add_action( 'admin_enqueue_scripts', [$this, 'jsEnqueuer'] );
            add_action( 'admin_enqueue_scripts', [$this, 'cssEnqueuer'] );
        }
        else
        {
            add_action( 'wp_enqueue_scripts', [$this, 'jsEnqueuer'] );
            add_action( 'wp_enqueue_scripts', [$this, 'cssEnqueuer'] );
        }
    }

    /**
     * set enqueuer scope admin|client
     *
     * @param string|EnqueuerScopeEnum $scope
     * @return self
     */
    public function scope(string|EnqueuerScopeEnum $scope) : self
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * set js path
     *
     * @param string|array ...$path
     * @return self
     */
    public function js(string|array ...$path) : self
    {
        $this->js = array_merge($this->js, $path);
        return $this;
    }

    /**
     * set css path
     *
     * @param string|array ...$path
     * @return self
     */
    public function css(string|array ...$path) : self
    {
        $this->css = array_merge($this->css, $path);
        return $this;
    }

    /**
     * Execute wp method wp_enqueue_scripts
     *
     * @return void
     */
    public function jsEnqueuer()
    {
        collect($this->js)->flatten()
        ->each(function($path)
        {
            $actual_path = WPDF_PLUGIN_PATH . $path;
            if(file_exists($actual_path) && pathinfo($actual_path, PATHINFO_EXTENSION) == 'js')
            {
                wp_enqueue_script('wpfrm_'.$this->scope.'_js_'. basename($path, '.js'), WPDF_PLUGIN_URI . $path);
            }
        });

    }

    /**
     * Execute wp method wp_enqueue_style
     *
     * @return void
     */
    public function cssEnqueuer()
    {
        collect($this->css)->flatten()
        ->each(function($path)
        {
            $actual_path = WPDF_PLUGIN_PATH . $path;
            if(file_exists($actual_path) && pathinfo($actual_path, PATHINFO_EXTENSION) == 'css')
            {
                wp_enqueue_style('wpfrm_'.$this->scope.'_css_'. basename($path, '.css'), WPDF_PLUGIN_URI . $path);
            }
        });
    }


}