<?php

namespace Source\Support\Log\handler;

use DateTimeImmutable;
use Source\Support\Log\Logger;

abstract class AbstractHandler implements HandlerInterface
{
    protected int $level;

    public function __construct(int $level = Logger::DEBUG)
    {
        $this->level = $level;
    }

    public function handle(array $log): void
    {
        if($this->isHandling($log))
            $this->execute($log);
    }

    public function isHandling(array $log): bool
    {
        return $log['level'] >= $this->level;
    }

    protected function getMessage(array $log): string
    {
        $formatted_date_time = $this->formatDateTime($log['date_time']);

        $message = $formatted_date_time . $log['channel'] . '.' .  $log['level_name'];

        $message .= ': ' . $log['message'];

        $context = $this->getFormatContext($log['context']);
        
        return $message . $context;
    }

    protected function getFormatContext($context): ?string
    {
        return $context ? json_encode($context) : null;
    }

    protected function formatDateTime(DateTimeImmutable $date_time): string
    {
        $formatted_date_time = $date_time->format('d/m/Y H:i:s');

        return  '[' . $formatted_date_time . '] ';
    }

    abstract protected function execute(array $log): void;
}