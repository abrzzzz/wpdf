<?php 
namespace Abrz\WPDF\Services\WPAPI;

use Abrz\WPDF\Contracts\WPAPIContract;
use Abrz\WPDF\Services\WPAPI\Cron\Cron;
use Abrz\WPDF\Services\WPAPI\Hook\Hook;
use Abrz\WPDF\Services\WPAPI\Metabox\Metabox;
use Abrz\WPDF\Services\WPAPI\PostType\PostType;
use Abrz\WPDF\Services\WPAPI\Taxonomy\Taxonomy;
use Abrz\WPDF\Services\WPAPI\Setting\Setting;
use Abrz\WPDF\Services\WPAPI\Shortcode\Shortcode;

class WPAPI implements WPAPIContract
{

    public static function setting()
    {
        return new Setting();
    }

    public static function shortcode()
    {
        return new Shortcode();
    }

    public static function postType()
    {
        return new PostType();
    }

    public static function taxonomy()
    {
        return new Taxonomy();
    }

    public static function cron()
    {
        return new Cron();
    }

    public static function metabox()
    {
        return new Metabox();
    }

    public static function hook()
    {
        return new Hook();
    }

}