<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use WP_Filesystem_Direct;

class FileDirectServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        if( !class_exists( 'WP_Filesystem_Direct' ) ) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
            require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
        }

        $this->app->singleton('file.direct', function(Application $app){
            return  new WP_Filesystem_Direct([]);
        });
    }

}