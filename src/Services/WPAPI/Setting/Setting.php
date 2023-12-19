<?php
namespace Abrz\WPDF\Services\WPAPI\Setting;

use Illuminate\Support\Str;
use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Services\WPAPI\Setting\Enum\OptionGroupEnum;
use Closure;

class Setting implements HookContract
{

    /**
     * $name
     *
     * @var string
     */
    private string $name;

    /**
     * $sectionTitle
     *
     * @var string
     */
    private string $sectionTitle;

    /**
     * $sectionCallback
     *
     * @var string|Closure
     */
    private string|Closure $sectionCallback;

    /**
     * $fieldTitle
     *
     * @var string
     */
    private string $fieldTitle;

    /**
     * $fieldCallback
     *
     * @var string|Closure
     */
    private string|Closure $fieldCallback;

    /**
     * $optionGroup
     *
     * @var string
     */
    private string $optionGroup = OptionGroupEnum::OPTIONS;

    /**
     * Register setting
     *
     * @return void
     */
    public  function register() 
    {
        add_action('admin_init', function(){

            register_setting($this->optionGroup, $this->name);

            add_settings_section(
                Str::slug($this->sectionTitle, '_'),
                $this->sectionTitle, 
                function()
                {
                    app()->call($this->sectionCallback);
                },
                $this->optionGroup
            );
    
            add_settings_field(
                Str::slug($this->fieldTitle, '_'),
                $this->fieldTitle, 
                function()
                {
                    app()->call($this->fieldCallback);
                },
                $this->optionGroup,
                Str::slug($this->sectionTitle, '_')
            );

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
     * set $sectionTitle
     *
     * @param string $sectionTitle
     * @return self
     */
    public function sectionTitle(string $sectionTitle) : self
    {
        $this->sectionTitle = $sectionTitle;
        return $this;
    }

    /**
     * set $fieldTitle
     *
     * @param string $fieldTitle
     * @return self
     */
    public function fieldtitle(string $fieldTitle) : self
    {
        $this->fieldTitle = $fieldTitle;
        return $this;
    }

    /**
     * set $optionGroup
     *
     * @param string $optionGroup
     * @return self     
     */
    public function optionGroup(string $optionGroup) : self
    {
        $this->optionGroup = $optionGroup;
        return $this;
    }

    /**
     * set $sectionCallback
     *
     * @param string|Closure $closure
     * @return self
     */
    public function sectionCallback(string|Closure $closure) : self
    {
        $this->sectionCallback =  $closure;
        return $this;
    }

    /**
     * set $fieldCallback
     *
     * @param string|Closure $closure
     * @return self
     */
    public function fieldCallback(string|Closure $closure) : self
    {
        $this->fieldCallback = $closure;
        return $this;
    }

}