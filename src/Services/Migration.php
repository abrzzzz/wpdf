<?php 
namespace Abrz\WPDF\Services;

use Abrz\WPDF\Facades\App;
use Abrz\WPDF\Facades\FileDirect;

class Migration 
{

    /**
     * Create and register all tables
     *
     * @return void
     */
    public static function up($classes = [])
    {

        if($classes)
        {
            collect($classes)->each(fn($class) => $class::up());
        } 

        $files = FileDirect::dirlist(App::getDatabasePath());
        foreach ($files as $name => $meta) 
        {
            $class = Extractor::getClassFromFile($name, App::getDatabasePath());
            if($class)
            {
                $class::up();                               
            }

        }

    }

    /**
     * Drop all tables
     *
     * @return void
     */
    public static function down($classes = [])
    {

        if($classes) 
        {
            collect($classes)->each(fn($class) => $class::down());
            return;
        }

        $files = FileDirect::dirlist(App::getDatabasePath());
        foreach ($files as $name => $meta) 
        {
            $class = Extractor::getClassFromFile($name, App::getDatabasePath());
            if($class)
            {
                $class::down();                               
            }

        }

    }


    public static function refresh($classes = [])
    {
        self::down($classes);
        self::up($classes);
    }

    
}
