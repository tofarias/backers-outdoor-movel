<?php

use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
    public function up()
    {
        $this->table('user')
            ->addColumn('name','string')
            ->addColumn('email','string')
            ->addColumn('password','string')
            ->addColumn('created_at','datetime')
            ->addColumn('updated_at','datetime')

            ->addIndex(['email'],['unique' => true])

            ->create();
    }

    public function down()
    {
        $this->table('user')->drop()->save();
    }
}
