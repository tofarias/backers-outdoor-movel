<?php

use Phinx\Migration\AbstractMigration;

class CreateClient extends AbstractMigration
{
    public function up()
    {
        $this->table('client')
            ->addColumn('name','string',['null' => true])
            ->addColumn('email','string')
            ->addColumn('phone_prefix','string',['null' => true])
            ->addColumn('phone','string',['null' => true])
            ->addColumn('created_at','datetime')
            ->addColumn('updated_at','datetime')
            ->addColumn('car_model','string', ['null' => true])
            ->addColumn('car_color','string', ['null' => true])
            ->addColumn('doc_id','string')
            ->addColumn('doc_type','enum',['values' => ['cpf', 'cnpj']])
            ->addColumn('company_category','string', ['null' => true])

            ->create();
    }

    public function down()
    {
        $this->table('client')->drop()->save();
    }
}
