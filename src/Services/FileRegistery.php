<?php 
namespace Abrz\WPDF\Services;

use Abrz\WPDF\Contracts\RegisteryContract;

class FileRegistery implements RegisteryContract
{

    private $files = [];

    private static $instance;

    public static function getInstance() : FileRegistery 
    {
        
        if(!self::$instance){
            $instance = new self;
        }   
        return $instance;
    }

    public function add($key, $value) : bool  
    {
        $files[$key] = $value;
        return true;
    }
    

    public function remove($key) : bool
    {
        try {
            unset($files[$key]);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    function  getClassesFromPath($path, $recursively = false) : array 
    {
        $files = scandir($path, SCANDIR_SORT_ASCENDING);
        $classes = [];

        foreach ($files as $file) 
        {    
            if(in_array($file, ['..', '.'])) continue;
            if(is_file($path.'/'.$file)){
                $className = explode('.', $file);
                $classes[] = "\\".$this->extractNamespace($path . '/' . $file).'\\'.$className[0];
            }
            if($recursively && is_dir($path.'/'.$file)){
                $this->getClassesFromPath($path.'/'.$file);
            }
        }
        return $classes;
    }

    private function extractNamespace(string $src) : string
    {
        $contents = file_exists($src) ? file_get_contents($src) : $src;
        if(preg_match('#^namespace\s+(.+?);$#sm', $contents, $m)){
            return $m[1];
        }
        return null;
    }


}