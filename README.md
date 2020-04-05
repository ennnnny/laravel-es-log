# laravel-es-log
Elasticsearch logger for Laravel
# Installation

```bash
$ composer require ennnnny/laravel-es-log
$ php artisan vendor:publish --tag=ennnnny.es_log
```

# Config

You can modify config in `config/logger.php`.

Now we can add the `channel` of `channels` in `config/logging.php` file.

```php
'channels' => [
    'elastic' => [
        'driver' => 'monolog',
        'handler' => \Monolog\Handler\ElasticsearchHandler::class,
        'handler_with' => [
            'options' => config('es_log.options'),
            'level' => config('es_log.level'),
            'bubble' => config('es_log.bubble')
        ],
        'formatter' => \Eslog\Formatter\EslogFormatter::class,
    ],
],
```
Now define the environment variable in `.env` file like this:

```
LOG_CHANNEL=elastic
ELASTICSEARCH_LOG_LEVEL=200
ELASTICSEARCH_HOST=localhost
ELASTICSEARCH_PORT=9200
ELASTICSEARCH_SCHEME=http
ELASTICSEARCH_USER=
ELASTICSEARCH_PASS=
```
## Credits

- [betterde](https://github.com/betterde/logger)
- [ahmedofali](https://github.com/ahmedofali/laravel-elk-log)
