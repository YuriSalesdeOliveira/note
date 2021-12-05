<?php

namespace Source\Support\Log\handler;

class StreamHandler extends AbstractHandler
{
    public function __construct($level)
    {
        parent::__construct($level);
    }

    public function execute(array $log): void
    {
        $message = $this->getMessage($log);
        
        $this->writeMessage($message);
    }

    private function writeMessage(string $message)
    {
        fileWrit(PATH['storage'] . '/log/log.text', "{$message}\n");
    }
}