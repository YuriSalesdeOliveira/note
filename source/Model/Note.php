<?php

namespace Source\Model;

class Note extends Model
{
    protected static string $entity = 'notes';
    protected static array $columns = [
        'title' => 'require',
        'content' => 'require',
    ];
}