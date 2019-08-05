<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run()
    {
        #$app = require __DIR__ . '/../bootstrap.php';
        #$auth = $app->service('auth');

        $faker = \Faker\Factory::create('pt_BR');
        $users = $this->table('user');
        $users->insert([
            'name' => 'Adminstrador',
            'email' => 'user@admin.com',
            #'password' => $auth->hashPassword('123456'),
            'password' => '123456',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ])->save();
    }
}