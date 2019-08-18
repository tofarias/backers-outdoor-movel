<?php

use Phinx\Migration\AbstractMigration;

class CreateSite extends AbstractMigration
{
    public function up()
    {
        $this->table('site')
            ->addColumn('url','string')
            ->addColumn('text','string', ['limit' => 1000])
            ->addColumn('created_at','datetime')
            ->addColumn('updated_at','datetime')

            ->create();
    }

    public function down()
    {
        $this->table('site')->drop()->save();
    }
}
