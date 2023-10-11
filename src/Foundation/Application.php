<?php 
namespace Abrz\WPDF\Foundation;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;
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
        foreach ($this::getProviders() as $key => $value) 
        {
            $provider = new ReflectionClass($value);
            $provider = $provider->newInstance($this);
            if(method_exists($provider, 'register'))
            {
                $provider->register();
            }


            
            if (method_exists($provider, 'boot')) {
                $this->call([$provider, 'boot']);
            }
    
        }
        return $this;
    }

    private function registerBaseServices() : void 
    {
        
    }

    private function setServiceAilases() : void
    {
        foreach ([
            'db' => [\Illuminate\Database\DatabaseManager::class, \Illuminate\Database\ConnectionResolverInterface::class],
            'db.connection' => [\Illuminate\Database\Connection::class, \Illuminate\Database\ConnectionInterface::class],
            'db.schema' => [\Illuminate\Database\Schema\Builder::class],
            'config' => [\Illuminate\Config\Repository::class, \Illuminate\Contracts\Config\Repository::class],
            'events' => [\Illuminate\Events\Dispatcher::class, \Illuminate\Contracts\Events\Dispatcher::class],
        ] as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->alias($key, $alias);
            }
        }
    }

} 