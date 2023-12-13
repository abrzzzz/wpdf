<?php 
namespace Abrz\WPDF\Services\WPAPI\Hook;

use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Services\WPAPI\Hook\Enum\HookTypeEnum;
use Closure;
use ReflectionFunction;

class Hook implements HookContract
{

    private $name;

    private Closure|string $callback;

    private string|HookTypeEnum $type = HookTypeEnum::ACTION; 

    private int $priority = 10;

    private int $acceptedArgs = 1;

    public function register()
    {
        $this->applyHook();
    }

    public function name( string $name )
    {
        $this->name = $name;
        return $this;
    }

    public function type( string|HookTypeEnum $type )
    {
        $this->type = $type;
        return $this;
    }

    public function callback( Closure|string $callback )
    {
        $this->callback =  $callback;
        return $this;
    }

    public function priority( int $priority )
    {
        $this->priority =  $priority;
        return $this;
    }

    public function acceptedArgs( int $acceptedArgs )
    {
        $this->acceptedArgs =  $acceptedArgs;
        return $this;
    }

    private function applyHook()
    {

        if($this->type == HookTypeEnum::ACTION){
            add_action(
                $this->name, 
                function(...$args){
                    return app()->call($this->callback, $this->extractParams($args));
                },
                $this->priority,
                $this->acceptedArgs
            );
            return;
        };

        add_filter(
            $this->name, 
            function(...$args){
                return app()->call($this->callback, $this->extractParams($args));
            },
            $this->priority,
            $this->acceptedArgs
        );   

        return;
    }

    private function extractParams(array $args)
    {
        $info = new ReflectionFunction($this->callback);
        $keys =  collect($info->getParameters())->pluck('name');
        $values = collect($args);
        return $keys->combine($values)->toArray();
    }


}