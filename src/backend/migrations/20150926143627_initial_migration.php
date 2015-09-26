<?php

use Phinx\Migration\AbstractMigration;

class InitialMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('board', ['id' => true])
            ->addColumn('url', 'string')
            ->addColumn('title', 'string')
            ->addColumn('description', 'text')
            ->create()
        ;

        $this->table('thread', ['id' => true])
            ->addColumn('board_id', 'integer')
            ->addColumn('date_created_on', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('date_updated_on', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('board_id', 'board', 'id')
            ->create()
        ;

        $this->table('post', ['id' => true])
            ->addColumn('thread_id', 'integer')
            ->addColumn('author', 'string')
            ->addColumn('email', 'string')
            ->addColumn('content', 'text')
            ->addColumn('date_created_on', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('date_updated_on', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('thread_id', 'thread', 'id')
            ->create()
        ;
    }
}
