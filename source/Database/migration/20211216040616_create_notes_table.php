<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateNotesTable extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('notes');
        $table->addColumn('title', 'string', ['limit' => 150])
        ->addColumn('content', 'string')
        ->addColumn('user', 'integer')
        ->addColumn('color', 'integer')
        ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'timestamp', ['null' => true])
        ->addForeignKey('user', 'users', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
        ->addForeignKey('color', 'note_colors', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
        ->create();
    }
}
