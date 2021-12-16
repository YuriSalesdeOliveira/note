<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNoteColorsTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('note_colors');
        $table->addColumn('name', 'string', ['limit' => 100])
        ->addColumn('color', 'string', ['limit' => 7])
        ->addColumn('background_color', 'string', ['limit' => 7])
        ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'timestamp', ['null' => true])
        ->create();
    }
}
