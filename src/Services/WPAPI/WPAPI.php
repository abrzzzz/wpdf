<?php 
namespace Abrz\WPDF\Services\WPAPI;

use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Contracts\WPAPIContract;
use Abrz\WPDF\Include\Exceptions\MethodDoesNotExistException;
use Abrz\WPDF\Services\WPAPI\Cron\Cron;
use Abrz\WPDF\Services\WPAPI\Enqueuer\Enqueuer;
use Abrz\WPDF\Services\WPAPI\Hook\Hook;
use Abrz\WPDF\Services\WPAPI\Metabox\Metabox;
use Abrz\WPDF\Services\WPAPI\PostType\PostType;
use Abrz\WPDF\Services\WPAPI\Taxonomy\Taxonomy;
use Abrz\WPDF\Services\WPAPI\Setting\Setting;
use Abrz\WPDF\Services\WPAPI\Shortcode\Shortcode;

final class WPAPI implements WPAPIContract
{

    /**
     * Instance of Setting API class
     *
     * @return HookContract
     */
    public static function setting() : HookContract
    {
        return new Setting();
    }

    /**
     * Instance of Shortcode API class
     *
     * @return HookContract
     */
    public static function shortcode() : HookContract
    {
        return new Shortcode();
    }

    /**
     * Instnce of postType API class
     *
     * @return HookContract
     */
    public static function postType() : HookContract
    {
        return new PostType();
    }

    /**
     * Instance of Taxonomy API class
     *
     * @return HookContract
     */
    public static function taxonomy() : HookContract
    {
        return new Taxonomy();
    }

    /**
     * Instance of Cron API class
     *
     * @return HookContract
     */
    public static function cron() : HookContract
    {
        return new Cron();
    }

    /**
     * Instance of Metabox API class
     *
     * @return HookContract
     */
    public static function metabox() : HookContract
    {
        return new Metabox();
    }

    /**
     * Instance of Hook API class
     *
     * @return HookContract
     */
    public static function hook() : HookContract
    {
        return new Hook();
    }

    /**
     * Instance of Enqueuer API class
     *
     * @return HookContract
     */
    public static function enqueuer() : HookContract
    {
        return new Enqueuer();
    }

    /**
     * Magic __call method
     *
     * @param [type] $name
     * @param [type] $arguments
     * @return void
     */
    public function __call($name, $arguments)
    {
        if(!method_exists($this, $name))
        {
            throw new MethodDoesNotExistException($name, __CLASS__);
        }
    }

    /**
     * Magic __callStatic method
     *
     * @param [type] $name
     * @param [type] $arguments
     * @return void
     */
    public static function __callStatic($name, $arguments)
    {
        if(!method_exists(self, $name))
        {
            throw new MethodDoesNotExistException($name, __CLASS__);   
        }
    }

}