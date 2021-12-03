<?php

namespace Source\Model;

class NoteColor extends Model
{
    protected static string $entity = 'notes_colors';
    protected static array $columns = [
        'name' => 'require',
        'color' => 'require',
        'backgrond_color' => 'require',
    ];

}