<?php 
namespace Abrz\WPDF\Include;

use Illuminate\Support\Facades\Facade as FacadesFacade;

class Facade extends FacadesFacade
{


    /**
     * Resolve the facade root instance from the container.
     *
     * @param  string  $name
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        return static::$app->make($name);
    }


    /**
     * Get the application default aliases.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function defaultAliases()
    {
        return collect([]);
    }


}