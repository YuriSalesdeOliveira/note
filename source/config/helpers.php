<?php

use Source\Support\Flash;

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

function logs()
{
    
}