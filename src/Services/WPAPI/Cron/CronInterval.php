<?php 
namespace Abrz\WPDF\Services\WPAPI\Cron;

use Abrz\WPDF\Contracts\HookContract;

class CronInterval implements HookContract
{

    /**
     * $name
     *
     * @var string
     */
    private string $name;

    /**
     * $interval
     *
     * @var string
     */
    private string $interval;
    
    /**
     * $label
     *
     * @var string
     */
    private string $label;

    /**
     * Register the cron interval
     *
     * @return void
     */
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
     * set $interval
     *
     * @param string $interval
     * @return self
     */
    public function interval(string $interval) : self
    {
        $this->interval = $interval;
        return $this;
    }
    
    /**
     * set $label
     *
     * @param string $label
     * @return self
     */
    public function label(string $label) : self
    {
        $this->label = $label;
        return $this;
    }
    

}