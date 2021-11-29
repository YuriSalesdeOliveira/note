<?php

namespace Source\Support\Log\handler;

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

    abstract protected function execute(array $log): void;
}