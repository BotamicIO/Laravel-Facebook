<?php

namespace BrianFaust\Facebook;

use BrianFaust\ServiceProvider\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider.
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('facebook.auth.manager', function ($app) {
            return new FacebookManager($app->session);
        });
    }

    /**
     * @return string
     */
    protected function getPackageName()
    {
        return 'facebook';
    }
}
