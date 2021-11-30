<?php

namespace Source\Support\Log\handler;

use TelegramBot\Api\BotApi;

class TelegramHandler extends AbstractHandler
{

    public string $telegram_bot_token;
    public int $telegram_chat_id;

    public function __construct(string $telegram_bot_token, int $telegram_chat_id, int $level)
    {
        parent::__construct($level);
        $this->telegram_bot_token = $telegram_bot_token;
        $this->telegram_chat_id = $telegram_chat_id;
    }

    public function execute(array $log): void
    {
        $message = $this->getMessage($log);
        
        $this->sendMessage($message);
    }

    private function sendMessage(string $message)
    {
        $bot_api = new BotApi($this->telegram_bot_token);

        $bot_api->sendMessage($this->telegram_chat_id, $message);
    }
}
