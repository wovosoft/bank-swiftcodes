<?php

namespace Wovosoft\BankSwiftcodes;

use Illuminate\Support\ServiceProvider;
use Wovosoft\BankSwiftcodes\Console\Commands\ImportSwiftCode;

class BankSwiftcodesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'wovosoft');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'wovosoft');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/bank-swiftcodes.php', 'bank-swiftcodes');

        // Register the service the package provides.
        $this->app->singleton('bank-swiftcodes', function ($app) {
            return new BankSwiftcodes;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['bank-swiftcodes'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/bank-swiftcodes.php' => config_path('bank-swiftcodes.php'),
        ], 'bank-swiftcodes.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/wovosoft'),
        ], 'bank-swiftcodes.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/wovosoft'),
        ], 'bank-swiftcodes.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/wovosoft'),
        ], 'bank-swiftcodes.views');*/

        // Registering package commands.
        $this->commands([
            ImportSwiftCode::class
        ]);
    }
}
