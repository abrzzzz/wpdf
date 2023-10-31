<?php 
namespace Abrz\WPDF\Services;

use Abrz\WPDF\Contracts\HookerContract;
use Abrz\WPDF\Facades\File;

class AdminEnqueuer implements HookerContract
{


    public function hooks()
    {
        // add_action( 'admin_enqueue_scripts', [$this, 'js'] );
        // add_action( 'admin_enqueue_scripts', [$this, 'css'] );
    
    }

    public static function js($path)
    {
        if(File::is_file($path) && pathinfo($path, PATHINFO_EXTENSION) == 'js')
        {
            wp_enqueue_script('wpfrm_admin_js_'. basename($path, '.js'), $path);
        }
    }

    public static function css($path)
    {
        if(File::is_file($path) && pathinfo($path, PATHINFO_EXTENSION) == 'css')
        {
            wp_enqueue_style('wpfrm_admin_css_'. basename($path, '.js'), $path);
        }
    }


}