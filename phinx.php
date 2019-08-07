<?php

require __DIR__.'/vendor/autoload.php';

if( file_exists(__DIR__.'/.env') ){
    $dotEnv = \Dotenv\Dotenv::create(__DIR__);
    $dotEnv->overload();
}

date_default_timezone_set('America/Sao_Paulo');

$db = include __DIR__.'/config/db.php';

list(
    'driver'    => $adapter,
    'host'      => $host,
    'database'  => $name,
    'username'  => $user,
    'password'  => $pass,
    'charset'   => $charset,
    'collation' => $collation
    ) = $db['default_connection'];

return [
  'paths' => [
      'migrations' => [
          __DIR__.'/db/migrations'
      ],
      'seeds' => [
          __DIR__.'/db/seeds'
      ]
  ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'default_connection',
        'development' => [
            'adapter'   => $adapter,
            'host'      => $host,
            'name'      => $name,
            'user'      => $user,
            'pass'      => $pass,
            'charset'   => $charset,
            'collation' => $collation
        ]
    ]
];