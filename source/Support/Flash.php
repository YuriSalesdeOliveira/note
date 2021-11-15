<?php

namespace Source\Support;

use Exception;

class Flash
{
    private static array $types = [
        'error',
        'success',
        'warning'
    ];

    public static function add(array $messages, string $type = 'error'): bool
    {
        self::filterType($type);

        foreach ($messages as $key => $message)
            $_SESSION[$type][$key] = $message;
        
        return true;
    }

    public static function get(string $type, string $key = ''): string|array|null
    {
        self::filterType($type);

        if ($key) {

            if (isset($_SESSION[$type][$key]) && $message = $_SESSION[$type][$key]) {
                
                unset($_SESSION[$type][$key]);
                
                return $message;
            }

            return null;
        }

        return $_SESSION[$type] ?? null;
    }

    protected static function filterType(string $type): bool
    {
        if (!in_array($type, self::$types))
            throw new Exception('Tipos permitidos ' . implode(',', self::$types));

        return true;
    }
}