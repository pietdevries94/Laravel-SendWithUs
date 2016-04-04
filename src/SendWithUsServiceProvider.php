<?php

/*
 * This file is part of Laravel SendWithUs.
 *
 * (c) Piet de Vries <piet@compenda.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Compenda\SendWithUs;

use sendwithus\API;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the sendwithus service provider class.
 *
 * @author Piet de Vries <piet@compenda.nl>
 */
class SendWithUsServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/sendwithus.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('sendwithus.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('sendwithus');
        }

        $this->mergeConfigFrom($source, 'sendwithus');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('sendwithus.factory', function () {
            return new SendWithUsFactory();
        });

        $this->app->alias('sendwithus.factory', SendWithUsFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('sendwithus', function (Container $app) {
            $config = $app['config'];
            $factory = $app['sendwithus.factory'];

            return new SendWithUsManager($config, $factory);
        });

        $this->app->alias('sendwithus', SendWithUsManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('sendwithus.connection', function (Container $app) {
            $manager = $app['sendwithus'];

            return $manager->connection();
        });

        $this->app->alias('sendwithus.connection', API::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'sendwithus.factory',
            'sendwithus',
            'sendwithus.connection',
        ];
    }
}
