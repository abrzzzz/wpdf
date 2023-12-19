<?php 
namespace Abrz\WPDF\Services\WPAPI\Hook;

use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Services\WPAPI\Hook\Enum\HookTypeEnum;
use Closure;
use ReflectionFunction;

class Hook implements HookContract
{
    
    /**
     * $name
     *
     * @var string
     */
    private string $name;

    /**
     * $callback
     *
     * @var Closure|string
     */
    private Closure|string $callback;

    /**
     * $type
     *
     * @var string|HookTypeEnum
     */
    private string|HookTypeEnum $type = HookTypeEnum::ACTION; 

    /**
     * $priority
     *
     * @var integer
     */
    private int $priority = 10;

    /**
     * $acceptedArgs
     *
     * @var integer
     */
    private int $acceptedArgs = 1;

    /**
     * register the hook
     *
     * @return void
     */
    public function register()
    {
        $this->applyHook();
    }

    /**
     * set $name
     *
     * @param string $name
     * @return self
     */
    public function name( string $name ) : self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * set $type
     *
     * @param string|HookTypeEnum $type
     * @return self
     */
    public function type( string|HookTypeEnum $type ) : self
    {
        $this->type = $type;
        return $this;
    }

    /**
     * set $callback
     *
     * @param Closure|string $callback
     * @return self
     */
    public function callback( Closure|string $callback ) : self
    {
        $this->callback =  $callback;
        return $this;
    }

    /**
     * set $priority
     *
     * @param integer $priority
     * @return self
     */
    public function priority( int $priority ) : self
    {
        $this->priority =  $priority;
        return $this;
    }

    /**
     * set $accepterArgs
     *
     * @param integer $acceptedArgs
     * @return self
     */
    public function acceptedArgs( int $acceptedArgs ) : self
    {
        $this->acceptedArgs =  $acceptedArgs;
        return $this;
    }

    /**
     * Execute  & apply the wp hook
     *
     * @return void
     */
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

    }

    /**
     * Extract the params from the given args
     *
     * @param array $args
     * @return array
     */
    private function extractParams(array $args)
    {
        $info = new ReflectionFunction($this->callback);
        $keys =  collect($info->getParameters())->pluck('name');
        $values = collect($args);
        return $keys->combine($values)->toArray();
    }


}