<?php

/*
 * This file is part of Laravel Facebook.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

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
    public function register(): void
    {
        $this->app->singleton('facebook.auth.manager', function ($app) {
            return new FacebookManager($app->session);
        });
    }

    /**
     * @return string
     */
    protected function getPackageName(): string
    {
        return 'facebook';
    }
}
