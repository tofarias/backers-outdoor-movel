<?php

use Phinx\Migration\AbstractMigration;

class CreateClient extends AbstractMigration
{
    public function up()
    {
        $this->table('client')
            ->addColumn('name','string')
            ->addColumn('email','string')
            ->addColumn('phone_prefix','string')
            ->addColumn('phone','string')
            ->addColumn('created_at','datetime')
            ->addColumn('updated_at','datetime')
            ->addColumn('car_model','string', ['null' => true])
            ->addColumn('doc_id','string')
            ->addColumn('doc_type','enum',['values' => ['cpf', 'cnpj']])
            ->addColumn('company_category','string', ['null' => true])

            ->addIndex(['email'],['unique' => true])

            ->create();
    }

    public function down()
    {
        $this->table('client')->drop()->save();
    }
}
