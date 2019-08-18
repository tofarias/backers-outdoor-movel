<?php

use Phinx\Seed\AbstractSeed;

class SiteSeeder extends AbstractSeed
{
    public function run()
    {
        $app = require __DIR__ . '/../bootstrap.php';

        $faker = \Faker\Factory::create('pt_BR');
        $users = $this->table('site');
        $users->insert([
            'url' => '/site/texto/empresa',
            'text' => $faker->text(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ])->save();
    }
}