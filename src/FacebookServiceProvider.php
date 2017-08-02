<?php

/*
 * This file is part of Laravel Facebook.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Facebook;

use BrianFaust\ServiceProvider\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider.
 */
class FacebookServiceProvider extends BaseServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerManager();
    }

    /**
     * Register the manager.
     */
    private function registerManager()
    {
        $this->app->singleton('facebook.auth.manager', function ($app) {
            return new FacebookManager($app->session);
        });
    }
}
