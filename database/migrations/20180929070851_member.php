<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Member extends Migrator
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

    public function up(){
        $this->table('member')->drop()->save();
    }


    public function down(){
        $users = $this->table('member');
        $users->addColumn('region', 'string', ['limit' => 8])
              ->addColumn('mobile', 'string', ['limit' => 16])
              ->addColumn('nickname', 'string', ['limit' => 64])
              ->addColumn('headimgurl', 'string', ['limit' => 256])
              ->addColumn('sex', 'integer')
              ->addColumn('age', 'integer')
              ->addColumn('create_time', 'datetime')
              ->addColumn(['update_time', 'datetime'], ['null' => true])
              ->addColumn(['delete_time', 'datetime'], ['null' => true])
              ->addIndex(['mobile'], ['unique' => true])
              ->save();
    }
}
