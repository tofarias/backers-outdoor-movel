<?php

use \Psr\Http\Message\ServerRequestInterface;

$app->get(
    '/', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('site/index.html.twig', []);
    }, 'site.index'
);