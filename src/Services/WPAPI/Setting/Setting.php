<?php
namespace Abrz\WPDF\Services\WPAPI\Setting;

use Illuminate\Support\Str;
use Abrz\WPDF\Contracts\HookContract;
use Abrz\WPDF\Services\WPAPI\Setting\Enum\OptionGroupEnum;
use Closure;

class Setting implements HookContract
{

    private $name;

    private $sectionTitle;

    private $sectionCallback;

    private $fieldTitle;

    private $fieldCallback;

    private string $optionGroup = OptionGroupEnum::OPTIONS;

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


    public function name(string $name) : self
    {
        $this->name = $name;
        return $this;
    }

    public function sectionTitle(string $sectionTitle) : self
    {
        $this->sectionTitle = $sectionTitle;
        return $this;
    }

    public function fieldtitle(string $fieldTitle) : self
    {
        $this->fieldTitle = $fieldTitle;
        return $this;
    }

    public function optionGroup(string $optionGroup)
    {
        $this->optionGroup = $optionGroup;
        return $this;
    }

    public function sectionCallback(Closure $closure)
    {
        $this->sectionCallback =  $closure;
        return $this;
    }

    public function fieldCallback(Closure $closure)
    {
        $this->fieldCallback = $closure;
        return $this;
    }

}