<?php

namespace Source\Model;

class Note extends Model
{
    protected static string $entity = 'notes';
    protected static array $columns = [
        'title' => 'require',
        'content' => 'require',
        'user' => 'require',
    ];

    public function color(): object
    {
        if (!$noteColor = NoteColor::find(['id' => $this->color])->first())
            $noteColor = NoteColor::find(['id' => '1'])->first();

        return $noteColor;
    }
}

