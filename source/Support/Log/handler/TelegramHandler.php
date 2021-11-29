<?php

namespace Source\Support\Log\handler;

class TelegramHandler extends AbstractHandler
{
    public function execute(array $log): void
    {
        print_r($log);
    }
}
