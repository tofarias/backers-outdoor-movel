<?php

$app->get(
    '/clients', function () use ($app) {
        
        $model = new Backers\Models\Client();
        $clients = $model->all();

        $view = $app->service('view.renderer');
        return $view->render('clients/list.html.twig', compact('clients'));
    }, 'clients.list'
);

/*
$app->get(
    '/client', function () use ($app) {

        $auth = $app->service('auth');

        $repository = $app->service('category-cost.repository');
        $categories = $repository->findByField('user_id', $auth->user()->getId());

        $view = $app->service('view.renderer');
        return $view->render('client/list.html.twig', compact('categories'));
    }, 'client.list'
);
*/

$app->get(
    '/client/new', function () use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('client/create.html.twig');
    }, 'client.new'
);

$app->post(
    '/client/store', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');

        $data = $request->getParsedBody();
        $data['user_id'] = $auth->user()->getId();

        $repository = $app->service('category-cost.repository');
        $repository->create($data);

        return $app->route('client.list');
    }, 'client.store'
);

$app->get(
    '/client/{id}/edit', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');
        $repository = $app->service('category-cost.repository');

        $id = $request->getAttribute('id');

        $category = $repository->findOneBy(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ] 
        );

        $view = $app->service('view.renderer');
        return $view->render('client/edit.html.twig', compact('category'));
    }, 'client.edit'
);

$app->post(
    '/client/{id}/update', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');

        $id = $request->getAttribute('id');

        $repository = $app->service('category-cost.repository');
        // $category = $repository->find( $id );

        $data = $request->getParsedBody();
        $data['user_id'] = $auth->user()->getId();

        $repository->update(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ], $data 
        );

        return $app->route('client.list');
    }, 'client.update'
);

$app->get(
    '/client/{id}/show', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');

        $id = $request->getAttribute('id');

        $repository = $app->service('category-cost.repository');
        $category = $repository->findOneBy(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ] 
        );

        $view = $app->service('view.renderer');
        return $view->render('client/show.html.twig', compact('category'));
    }, 'client.show'
);

$app->get(
    '/client/{id}/delete', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $auth = $app->service('auth');
        $id = $request->getAttribute('id');

        $repository = $app->service('category-cost.repository');
        $repository->delete(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ]
        );

        return $app->route('client.list');
    }, 'client.delete'
);