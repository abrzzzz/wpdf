<?php 
namespace Abrz\WPDF;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use ReflectionClass;

final class DB
{
    private static $blueprint;

    private static $DB_PATH;

    public static function boot() : Capsule
    {
        global $wpdb;
     
        self::$DB_PATH = defined('WPDF_DB_PATH') ? constant('WPDF_DB_PATH') : "" ;

        if(!self::$blueprint){

            $capsule = new Capsule();
            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => 'localhost',
                'database' =>  'local',
                'username' =>  'root',
                'password' =>  'root',
                'charset' => 'utf8',
                'prefix' => $wpdb->prefix,
            ]);
    
            $capsule->setEventDispatcher(new Dispatcher(new Container));
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            self::$blueprint = $capsule;    
        }
        
        return self::$blueprint;
    }

    /**
     * Create and register all tables
     *
     * @return void
     */
    public static function up($classes = [])
    {
        self::boot();
        $tables = count($classes) ? $classes : FileRegistery::getInstance()
        ->getClassesFromPath(self::$DB_PATH);
        if($tables){
            for ($i=0; $i < count($tables); $i++) {
                $table = new ReflectionClass($tables[$i]);
                $table = $table->newInstance();
                $table::up((new Blueprint));
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
        self::boot();
        $tables = count($classes) ? $classes : FileRegistery::getInstance()
        ->getClassesFromPath(self::$DB_PATH);
        if($tables){
            for ($i=0; $i < count($tables); $i++) { 
                $table = new ReflectionClass($tables[$i]);
                $table = $table->newInstance();
                $table::down((new Blueprint));
            }
        }
    }

    
}
