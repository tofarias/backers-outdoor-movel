<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/helpers.php';

if( file_exists(__DIR__.'/../.env') ){
    $dotEnv = \Dotenv\Dotenv::create(__DIR__.'/../');
    $dotEnv->overload();
}

$serviceContainer = new \Backers\ServiceContainer();
$app = new \Backers\Application( $serviceContainer );

$app->plugin( new \Backers\Plugins\RoutePlugin() );
$app->plugin( new \Backers\Plugins\ViewPlugin() );
#$app->plugin( new \Backers\Plugins\DbPlugin() );
#$app->plugin( new \Backers\Plugins\AuthPlugin() );

$app->get('/', function(\Psr\Http\Message\RequestInterface $request) use ($app){

    $view = $app->service('view.renderer');
    return $view->render('test.html.twig',['name' => 'Tiago']);
});



$app->get('/home/{name}/{id}', function(\Psr\Http\Message\RequestInterface $request){
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write('response do Diactoros');
    return $response;
});

/*
require_once __DIR__.'/../src/controllers/category-costs.php';
require_once __DIR__.'/../src/controllers/bill-receives.php';
require_once __DIR__.'/../src/controllers/bill-pays.php';
require_once __DIR__.'/../src/controllers/users.php';
require_once __DIR__.'/../src/controllers/auth.php';
require_once __DIR__.'/../src/controllers/statements.php';
require_once __DIR__.'/../src/controllers/charts.php';
*/

$app->start();
