<?php
namespace EsLog\Formatter;

use Monolog\Formatter\ElasticsearchFormatter;

class EsLogFormatter extends ElasticsearchFormatter
{
    public function __construct(string $index, string $type)
    {
        parent::__construct($index, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function format(array $record)
    {
        $record = parent::format($record);
        $record = $this->getDocument($record);

        $record['extra'] = config('es_log.extra');

        if (isset($record['context']['exception']) && $record['context']['exception'] instanceof Exception) {
            /**
             * @var Exception $exception
             */
            $exception = $record['context']['exception'];
            $record['context'] = [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'previous' => $exception->getPrevious(),
                'trace' => config('es_log.exception.trace') ? $exception->getTraceAsString() : []
            ];
        }

        return $record;
    }
}
