<?php

namespace Eslog;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Eslog\Formatter\EslogFormatter;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class EslogServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /**
         * 发布配置文件
         */
        $this->publishes([
            __DIR__ . '/../config/es_log.php' => config_path('es_log.php'),
        ], 'ennnnny.es_log');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return ClientBuilder::create()->setHosts(config('es_log.elasticsearch.hosts'))
                ->setRetries(config('es_log.elasticsearch.retries'))->build();
        });

        $this->app->bind(EslogFormatter::class, function ($app) {
            return new EslogFormatter(config('elk.options.index'), config('elk.options.type'));
        });
    }
}
