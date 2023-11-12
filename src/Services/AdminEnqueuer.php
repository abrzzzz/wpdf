<?php 
namespace Abrz\WPDF\Services;

class AdminEnqueuer
{

    public function __construct()
    {
        add_action( 'admin_enqueue_scripts', [$this, 'js'] );
        add_action( 'admin_enqueue_scripts', [$this, 'css'] );
    }

    public static function js($path)
    {
        $actual_path = WPDF_PLUGIN_PATH . $path;
        if(file_exists($actual_path) && pathinfo($actual_path, PATHINFO_EXTENSION) == 'js')
        {
            wp_enqueue_script('wpfrm_admin_js_'. basename($path, '.js'), WPDF_PLUGIN_URI . $path);
        }
    }

    public static function css($path)
    {
        $actual_path = WPDF_PLUGIN_PATH . $path;
        if(file_exists($actual_path) && pathinfo($actual_path, PATHINFO_EXTENSION) == 'css')
        {
            wp_enqueue_style('wpfrm_admin_css_'. basename($path, '.js'), WPDF_PLUGIN_URI . $path);
        }
    }


}