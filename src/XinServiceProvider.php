<?php

namespace Petehouston\Xin;

use Illuminate\Support\ServiceProvider;

class XinServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/xin.php' => config_path('xin.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    /**
     * Register commands
     *
     * @return void
     */
    protected function registerCommands()
    {
        // command: xin:ip
        $this->app['command.xin.ip'] = $this->app->share(
            function ($app) {
                return new XinIpCommand();
            }
        );
        $this->commands('command.xin.ip');

        // command: xin:docs
        $this->app['command.xin.docs'] = $this->app->share(
            function ($app) {
                return new XinDocsCommand();
            }
        );
        $this->commands('command.xin.docs');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['command.xin.ip', 'command.xin.docs'];
    }
}