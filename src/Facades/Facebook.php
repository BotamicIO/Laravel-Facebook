<?php



declare(strict_types=1);



namespace BrianFaust\Facebook\Facades;

use Illuminate\Support\Facades\Facade;

class Facebook extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'facebook.auth.manager';
    }
}
