<?php 
namespace Abrz\WPDF\Foundation;

use Illuminate\Container\Container;
use ReflectionClass;

class Application extends Container
{


    private static $database_path;

    private static $service_path;


    public function __construct()
    {
        $this->registerServices();
        $this->setServiceAilases();
        
    }

    /**
     * Get the value of database_path
     */ 
    public static function getDatabasePath()
    {
        return self::$database_path;
    }

    /**
     * Set the value of database_path
     *
     * @return  self
     */ 
    public static function setDatabasePath($database_path) : self
    {
        self::$database_path = $database_path;
        return self::getInstance();
    }

    /**
     * Get the value of service_path
     */ 
    public static function getServicePath()
    {
        return self::$service_path;
    }

    /**
     * Set the value of service_path
     *
     * @return  self
     */ 
    public static function setServicePath($service_path) : self
    {
        self::$service_path = $service_path;
        return self::getInstance();
    }


    public static function getConfig() : array
    {
        $config = (array) include WPDF_PLUGIN_PATH . '/Config/app.php';
        return $config;
    }

    public static function getProviders() : array
    {
        $config = self::getConfig();
        return $config['providers'];
    }


    
    
    private function registerServices() : self 
    {
        foreach ($this::getProviders() as $key => $value) {
            $service = new ReflectionClass($value);
            $service = $service->newInstance($this);
            if(method_exists($service, 'register'))
            {
                $service->register();
            }
        }
        return $this;
    }

    private function registerBindedServices() : self 
    {
        
    }

    private function setServiceAilases() : self
    {
        return $this;;
    }

} 