<?php


use Phinx\Seed\AbstractSeed;

class NoteColorSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'name' => 'white',
                'color' => '#000000',
                'background_color' => '#ffffff'
            ],
            [
                'name' => 'brown',
                'color' => '#ffffff',
                'background_color' => '#706767'
            ],
            [
                'name' => 'coral',
                'color' => '#ffffff',
                'background_color' => '#e87474'
            ],
            [
                'name' => 'purple',
                'color' => '#ffffff',
                'background_color' => '#a5aad9'
            ],
            [
                'name' => 'blue',
                'color' => '#ffffff',
                'background_color' => '#4180ab'
            ]
        ];

        $noteColors = $this->table('note_colors');
        $noteColors->insert($data)->saveData();
    }
}
