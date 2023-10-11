<?php 
namespace Abrz\WPDF\Providers;

use Abrz\WPDF\Facades\App;
use Abrz\WPDF\Facades\CLI;
use Abrz\WPDF\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;
use ReflectionMethod;

class ConsoleServiceProvider extends ServiceProvider
{
   
    public function register() : void 
    {
        
        // register 

    }

    public function boot() : void
    {
        $cli = $this->app->make('cli');
        $commands = $this->app->make('config')->get('CLI');
        $commands = collect($commands['commands']);
        $commands->each(function($c) use ($cli) 
        {
            $class = new ReflectionClass($c);
            $instance = $class->newInstance();
            $methods = Collect($class->getMethods());
            
            $hooks = $methods->filter(function($m) {
                preg_match("/^hook_(\w+)/", $m->name, $match);
                if($match) {
                    $m->hook = $match[1];
                    return $m;
                };

            })->mapWithKeys(function($m, $key) use ($instance) {
                return [
                    $m->hook => [$instance, $m->name]
                ];
            })->all();
            
            $cli::add_command( $instance->command, [$instance, "handle"], $hooks );

        });
    }

}