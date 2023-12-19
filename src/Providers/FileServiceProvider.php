<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use WP_Filesystem_Base;

class FileServiceProvider extends ServiceProvider
{
   
    /**
     * Register wp filesystem service.
     *
     * @return void
     */
    public function register() : void 
    {
        if( !class_exists( 'WP_Filesystem_Direct' ) ) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
        }

        $this->app->singleton('file', function(Application $app){
            return  new WP_Filesystem_Base();
        });
    }

}