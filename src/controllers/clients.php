<?php

$app->get(
    '/clientes', function () use ($app) {

        #$auth = $app->service('auth');

        $repository = $app->service('client.repository');
        $clients = $repository->all();
        #$categories = $repository->findByField('user_id', $auth->user()->getId());

        $view = $app->service('view.renderer');
        return $view->render('clients/list.html.twig', compact('clients'));
    }, 'clients.list'
);

$app->get(
    '/cliente/new', function () use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('clients/create.html.twig');
    }, 'client.new'
);

$app->post(
    '/cliente/store', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        $data = $request->getParsedBody();
        #$data['user_id'] = $auth->user()->getId();

        $repository = $app->service('client.repository');
        $repository->create($data);

        return $app->route('clients.list');
    }, 'client.store'
);

$app->get(
    '/cliente/{id}/edit', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');
        $repository = $app->service('client.repository');

        $id = $request->getAttribute('id');

        $client = $repository->findOneBy(
            [
            'id' => $id,
            #'user_id' => $auth->user()->getId()
            ]
        );

        $view = $app->service('view.renderer');
        return $view->render('clients/edit.html.twig', compact('client'));
    }, 'client.edit'
);

$app->post(
    '/cliente/{id}/update', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        $repository = $app->service('client.repository');
        $client = $repository->find( $id );

        $data = $request->getParsedBody();
        #$data['user_id'] = $auth->user()->getId();

        $repository->update(
            [
            'id' => $id,
            #'user_id' => $auth->user()->getId()
            ], $data
        );

        return $app->route('clients.list');
    }, 'client.update'
);

$app->get(
    '/cliente/{id}/show', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        $id = $request->getAttribute('id');

        $repository = $app->service('client.repository');
        $client = $repository->findOneBy(
            [
            'id' => $id,
            #'user_id' => $auth->user()->getId()
            ]
        );

        $view = $app->service('view.renderer');
        return $view->render('clients/show.html.twig', compact('client'));
    }, 'client.show'
);

$app->get(
    '/cliente/{id}/delete', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');
        $id = $request->getAttribute('id');

        $repository = $app->service('client.repository');
        $repository->delete(
            [
            'id' => $id,
            #'user_id' => $auth->user()->getId()
            ]
        );

        return $app->route('clients.list');
    }, 'client.delete'
);