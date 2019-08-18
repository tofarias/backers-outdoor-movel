<?php

$app->get(
    '/admin/login', function () use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('auth/login.html.twig');
    }, 'auth.show_login_form'
);

$app->get(
    '/admin/logout', function () use ($app) {

        $auth = $app->service('auth')->logout();

        return $app->route('auth.show_login_form');
    }, 'auth.logout'
);

$app->post(
    '/admin/login', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $flash = $app->service('flash_message');
        $view = $app->service('view.renderer');
        $auth = $app->service('auth');

        $data = $request->getParsedBody();

        $result = $auth->login($data);

        if(!$result ) {

            $flash->error('Usuário ou senha incorretos!');
            return $view->render('auth/login.html.twig');
        }

        return $app->route('admin.index');
    }, 'auth.login'
);

$app->before(
    function () use ($app) {

        $route = $app->service('route');
        $auth = $app->service('auth');
        $routeWhiteList = [
        'auth.show_login_form',
        'auth.login',
        'site.index',
        'site.contact',
        'site.contact.message.send',
        'site.cliente.cadastrar',
        'site.cliente.post.cadastrar',
        'site.about'
        ];

        if(!in_array($route->name, $routeWhiteList) && !$auth->check() ) {
            return $app->route('auth.show_login_form');
        }
    }
);