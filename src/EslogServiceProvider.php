<?php

namespace EsLog;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use EsLog\Formatter\EsLogFormatter;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class EsLogServiceProvider extends LaravelServiceProvider
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

        $this->app->bind(EsLogFormatter::class, function ($app) {
            return new EsLogFormatter(config('elk.options.index'), config('elk.options.type'));
        });
    }
}
