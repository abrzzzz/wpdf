<?php
namespace Abrz\WPDF\Contracts;

interface WPAPIContract
{

    public static function setting();

    public static function shortcode();

    public static function postType();
    
    public static function taxonomy();
    
    public static function cron();

    public static function metabox();

    public static function hook();

    // public function heartbeat();

    // public function policy();


}