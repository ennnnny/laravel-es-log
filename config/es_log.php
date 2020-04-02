<?php
return [
    /*
     * Log level
     * 日志级别，值可以参考 Monolog\Logger.php 中的定义
     */
    'level' => env('ELASTICSEARCH_LOG_LEVEL', 200),

    /*
     * bubble
     * 是否在多个 Handler 中流转日志数据
     */
    'bubble' => false,

    /*
     * Elasticsearch DB
     */
    'elasticsearch' => [
        'hosts' => [
            [
                /*
                 * host is required
                 */
                'host' => env('ELASTICSEARCH_HOST', 'localhost'),
                'port' => env('ELASTICSEARCH_PORT', 9200),
                'scheme' => env('ELASTICSEARCH_SCHEME', 'http'),
                'user' => env('ELASTICSEARCH_USER', null),
                'pass' => env('ELASTICSEARCH_PASS', null)
            ],
        ],
        'retries' => 2,
        /*
         * Cart path
         */
        'cert' => ''
    ],

    /*
     * Handler options
     * Handler 的设置
     */
    'options' => [
        'index' => strtolower(env('APP_NAME', 'laravel')), // Elastic index name
        'type' => '_doc',    // Elastic document type
        'ignore_error' => false,     // Suppress Elasticsearch exceptions
    ],

    /*
     * Enable trace of exception log
     * 对于异常日志是否记录追踪详情
     */
    'exception' => [
        'trace' => false,
    ],

    /*
     * Log extra filed
     * 扩展属性，你可以用于 Elasticsearch Index，extra 数组里的 Key 都是可以自定义的，我这里只是举例
     */
    'extra' => [
        'host' => env('APP_URL'),
        'php' => PHP_VERSION,
        'laravel' => app()->version(),
        'env' => env('APP_ENV')
    ]
];
