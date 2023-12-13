<?php 
namespace Abrz\WPDF\Services\WPAPI\Cron;

use Abrz\WPDF\Contracts\HookContract;

class CronInterval implements HookContract
{

    private $name;

    private $interval;

    private $label;

    public function register()
    {
        add_filter( 'cron_schedules', function($schedules)
        {
            $schedules[$this->name] = [
                'interval' => $this->interval,
                'display'  => esc_html__( $this->label )
            ];
            return $schedules;
        });

    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function interval(string $interval)
    {
        $this->interval = $interval;
        return $this;
    }
    
    public function label(string $label)
    {
        $this->label = $label;
        return $this;
    }
    

}