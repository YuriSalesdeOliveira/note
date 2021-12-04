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

function fileWrit(string $file_path, string $content, bool $exists = true): bool
{
    /**
     * Posso adicionar validar a string file_path para ver se possui
     * um extensão valida no final da string e também informar o possivel
     * motivo pelo qual a fopen, fwrit ou fclose possa ter retornado false
     */

    $validation = $exists ? file_exists($file_path) : true;
    
    if ($validation) {
        
        if (!$file = fopen($file_path, 'a')) return false;

        if (fwrite($file, $content) === false || !fclose($file)) return false;

        return true;
    }
}

function fileRead(string $file_path, ?int $rows = null): bool|string
{
    if (file_exists($file_path)) {

        if (!$file = fopen($file_path, 'r')) return false;

        $content = '';

        if ($rows === null) {

            $file_size = filesize($file_path);

            $content = fread($file, $file_size);

            fclose($file);

            return $content;
        }

        while ($rows > 0 && !feof($file )) {

            $content .= fgets($file) . '\n';

            --$rows;
        }

        return $content;

    }

    return false;
}
