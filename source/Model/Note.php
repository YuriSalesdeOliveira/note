<?php

namespace Source\Model;

class Note
{
    protected static string $entity = 'notes';
    protected static array $columns = [
        'title' => 'require',
        'content' => 'require',
    ];
}