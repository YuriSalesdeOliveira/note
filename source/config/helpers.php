<?php

use Source\Support\Flash;
use Source\Support\Log\Log;
use Source\Support\Log\Logger;

function assets(string $path): string
{
    return SITE['root'] . "/{$path}";
}

function flashAdd(array $messages, string $type = 'error'): bool
{
    return Flash::add($messages, $type);
}

function flashGet(string $type, string $key = ''): string|array|null
{
    return Flash::get($type, $key);
}

function logs(string $channel = null): Logger
{
    $log = new Log(PATH['config']);
    return $log->channel($channel);
}
