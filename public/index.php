<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/helpers.php';

if( file_exists(__DIR__.'/../.env') ){
    $dotEnv = \Dotenv\Dotenv::create(__DIR__.'/../');
    $dotEnv->overload();
}

if( file_exists(__DIR__.'/../.mail.config.env') ){
    $dotEnv = \Dotenv\Dotenv::create(__DIR__,'/../.mail.config.env');
    $dotEnv->overload();
}

$serviceContainer = new \Backers\ServiceContainer();
$app = new \Backers\Application( $serviceContainer );

$app->plugin( new \Backers\Plugins\RoutePlugin() );
$app->plugin( new \Backers\Plugins\ViewPlugin() );
$app->plugin( new \Backers\Plugins\DbPlugin() );
$app->plugin( new \Backers\Plugins\AuthPlugin() );
$app->plugin( new \Backers\Plugins\SendMailPlugin() );

require_once __DIR__.'/../src/controllers/site.php';
require_once __DIR__.'/../src/controllers/clients.php';
require_once __DIR__.'/../src/controllers/auth.php';

/*
require_once __DIR__.'/../src/controllers/bill-receives.php';
require_once __DIR__.'/../src/controllers/bill-pays.php';
require_once __DIR__.'/../src/controllers/users.php';
require_once __DIR__.'/../src/controllers/statements.php';
require_once __DIR__.'/../src/controllers/charts.php';
*/

$app->start();
