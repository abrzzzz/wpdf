<?php 
namespace Abrz\WPDF\Services;

use Exception;

final class Extractor
{

    private static $instance;

    public static function getInstance() : Extractor 
    {
        
        if(!self::$instance){
            $instance = new self;
        }   
        return $instance;
    }

    public static function getClassFromFile($file, $path)
    {
        if(is_file($path . $file)) throw new Exception('the file given is not exist!');
        $className = explode('.', $file);
        return "\\". self::getNamespace($path . '/' . $file).'\\'.$className[0];
    }

    public static function getNamespace(string $src) : string
    {
        $contents = file_exists($src) ? file_get_contents($src) : $src;
        if(preg_match('#^namespace\s+(.+?);$#sm', $contents, $m)){
            return $m[1];
        }
        return null;
    }


}