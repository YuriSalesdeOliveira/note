<?php

namespace Source\Model;

class NoteColor extends Model
{
    protected static string $entity = 'note_colors';
    protected static array $columns = [
        'name' => 'require',
        'color' => 'require',
        'background_color' => 'require',
    ];

}