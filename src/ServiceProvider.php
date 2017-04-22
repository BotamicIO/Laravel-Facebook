<?php



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
