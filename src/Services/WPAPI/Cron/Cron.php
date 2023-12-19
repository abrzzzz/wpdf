<?php 
namespace Abrz\WPDF\Services\WPAPI\Cron;

use Abrz\WPDF\Contracts\HookContract;
use Closure;

class Cron implements HookContract
{
    
    /**
     * $name
     *
     * @var string
     */
    private string $name;

    /**
     * $execute
     *
     * @var Closure|string
     */
    private Closure|string $execute;

    /**
     * $start
     *
     * @var string
     */
    private $start;

    /**
     * $every
     *
     * @var string
     */
    private string $every;
    
    /**
     * $isSingle
     *
     * @var boolean
     */
    private $isSingle = false;

    /**
     * $args
     *
     * @var array
     */
    private array $args = [];

    /**
     * $withError
     *
     * @var boolean
     */
    private bool $withError = false;

    /**
     * Register the cron
     *
     * @return void
     */
    public function register()
    { 
        add_action( $this->name, function(){
            return app()->call($this->execute);
        } );

        if($this->isSingle)
            $this->singleSchedule();
        else
            $this->schedule();
    }

    /**
     * Add custom inerval
     *
     * @param [type] $name
     * @param [type] $interval
     * @param [type] $label
     * @return boolean
     */
    public function addCronInterval($name, $interval, $label) : bool
    {
        
        (new CronInterval)->name($name)
        ->interval($interval)
        ->label($label)
        ->register();

        return true;
    }

    /**
     * set $execute 
     *
     * @param Closure|string $execute
     * @return self
     */
    public function execute(Closure|string $execute) : self
    {
        $this->execute = $execute;
        return $this;
    }

    /**
     * set $start 
     *
     * @param string $start
     * @return self
     */
    public function start(string $start) : self
    {
        $this->start = $start;
        return $this;
    }

    /**
     * set $every
     *
     * @param string $every
     * @return self
     */
    public function every(string $every) : self
    {
        $this->every = $every;
        return $this;
    }

    /**
     * set $name
     *
     * @param string $name
     * @return self
     */
    public function name(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * set $isSingle
     *
     * @param boolean $isSingle
     * @return self
     */
    public function isSingle(bool $isSingle = true) : self
    {
        $this->isSingle = $isSingle;
        return $this;
    }

    /**
     * set $args
     *
     * @param [type] ...$args
     * @return self
     */
    public function args(...$args) : self
    {
        $this->args = $args;
        return $this;
    }

    /**
     * set $withError
     *
     * @param boolean $withError
     * @return self
     */
    public function withError(bool $withError) : self
    {
        $this->withError = $withError;
        return $this;
    }

    /**
     * check the given cron has scheduled or not
     *
     * @param string $name
     * @return boolean|string
     */
    public function isScheduled(string $name) : bool|string
    {
        return wp_next_scheduled($name);
    }

    /**
     * unschedule the given cron
     *
     * @param string $name
     * @return boolean
     */
    public function unSchedule(string $name)
    {
        if( $timestamp = $this->isScheduled( $name ) )
        {
            return wp_unschedule_event( $timestamp, $name );
        }
        return false;
    }

    /**
     * schedule the cron
     *
     * @return void
     */
    private function schedule()
    {
       
        if( ! $this->isScheduled($this->name) )
        {
            return wp_schedule_event( $this->start, $this->every, $this->name, $this->args, $this->withError );
        }
        return false;
    }

    /**
     * schedule the cron for single time
     *
     * @return void
     */
    private function singleSchedule()
    {
        if( ! $this->isScheduled($this->name) )
        {
            return wp_schedule_single_event( $this->start, $this->name, $this->args, $this->withError );
        }
        return false;
    }
    
}