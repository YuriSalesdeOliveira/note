<?php

use Source\Support\Log\handler\StreamHandler;
use Source\Support\Log\Logger;
use Source\Support\Log\handler\TelegramHandler;

return [

    /*
    |-----------------------------
    | Default Log Channel
    |-----------------------------
    */

    'default' => 'site',

    /*
    |-----------------------------
    | Log Channels
    |-----------------------------
    */

    'channels' => [

        'web' => [

        ],

        'site' => [
            'handlers' => [
                new StreamHandler(Logger::DEBUG),
                new TelegramHandler(TELEGRAM_CONFIG['bot_token'], TELEGRAM_CONFIG['chat_id'],
                Logger::WARNING)
            ]
        ],

        'auth' => [
            'handlers' => [
                new StreamHandler(Logger::DEBUG),
                new TelegramHandler(TELEGRAM_CONFIG['bot_token'], TELEGRAM_CONFIG['chat_id'],
                Logger::WARNING)
            ]
        ]

    ]
];