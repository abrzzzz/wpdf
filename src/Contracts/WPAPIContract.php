<?php
namespace Abrz\WPDF\Contracts;

interface WPAPIContract
{

    /**
     * New Instance of Setting API class 
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function setting() : HookContract;

    /**
     * New Instance of Shortcode API
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function shortcode() : HookContract;

    /**
     * New Instance of postType API class
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function postType() : HookContract;
    
    /**
     * New Instance of taxonomy API class
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function taxonomy() : HookContract;
    
    /**
     * New Instance of cron API class
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function cron() : HookContract;

    /**
     * New Instance of metabox API class
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function metabox() : HookContract;

    /**
     * New Instance of hook API class
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function hook() : HookContract;

    /**
     * New Instance of Enqueuer API class
     *
     * @return Abrz\WPDF\Contracts\HookContract
     */
    public static function enqueuer() : HookContract;

    // public function heartbeat();

    // public function policy();


}