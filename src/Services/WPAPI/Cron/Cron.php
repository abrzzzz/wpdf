<?php 
namespace Abrz\WPDF\Services\WPAPI\Cron;

use Abrz\WPDF\Contracts\HookContract;
use Closure;

class Cron implements HookContract
{

    private $name;

    private $execute;

    private $start;

    private $every;
    
    private $isSingle = false;

    private array $args = [];

    private bool $withError = false;

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

    public function addCronInterval($name, $interval, $label) : bool
    {
        
        (new CronInterval)->name($name)
        ->interval($interval)
        ->label($label)
        ->register();

        return true;
    }

    public function execute(Closure|string $execute)
    {
        $this->execute = $execute;
        return $this;
    }

    public function start(string $start)
    {
        $this->start = $start;
        return $this;
    }

    public function every(string $every)
    {
        $this->every = $every;
        return $this;
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function isSingle(bool $isSingle = true)
    {
        $this->isSingle = $isSingle;
        return $this;
    }

    public function args(...$args)
    {
        $this->args = $args;
        return $this;
    }

    public function withError(bool $withError)
    {
        $this->withError = $withError;
        return $this;
    }

    public function isScheduled(string $name)
    {
        return wp_next_scheduled($name);
    }

    public function unSchedule(string $name)
    {
        if( $timestamp = $this->isScheduled( $name ) )
        {
            return wp_unschedule_event( $timestamp, $name );
        }
        return false;
    }

    private function schedule()
    {
       
        if( ! $this->isScheduled($this->name) )
        {
            return wp_schedule_event( $this->start, $this->every, $this->name, $this->args, $this->withError );
        }
        return false;
    }

    private function singleSchedule()
    {
        if( ! $this->isScheduled($this->name) )
        {
            return wp_schedule_single_event( $this->start, $this->name, $this->args, $this->withError );
        }
        return false;
    }
    
}