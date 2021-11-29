<?php

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
                TelegramHandler::class => Logger::DEBUG
            ]
        ],

        'web' => [

        ]

    ]
];