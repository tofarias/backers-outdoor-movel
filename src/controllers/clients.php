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
    }, 'clients.list'
);
*/

$app->get(
    '/client/new', function () use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('clients/create.html.twig');
    }, 'client.new'
);

$app->post(
    '/client/store', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        $data = $request->getParsedBody();
        #$data['user_id'] = $auth->user()->getId();

        #$repository = $app->service('client.repository');
        #$repository->create($data);

        Backers\Models\Client::create( $data );

        return new \Zend\Diactoros\Response\RedirectResponse('/clients');

        //return $app->route('clients.list');
    }, 'client.store'
);

$app->get(
    '/client/{id}/edit', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        /*
        $auth = $app->service('auth');
        $repository = $app->service('category-cost.repository');

        $id = $request->getAttribute('id');

        $client = $repository->findOneBy(
            [
            'id' => $id,
            #'user_id' => $auth->user()->getId()
            ] 
        );*/

        $id = $request->getAttribute('id');

        $client = Backers\Models\Client::find( $id );

        $view = $app->service('view.renderer');
        return $view->render('clients/edit.html.twig', compact('client'));
    }, 'client.edit'
);

$app->post(
    '/client/{id}/update', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();

        #$repository = $app->service('category-cost.repository');
        // $category = $repository->find( $id );
        /*
        $data = $request->getParsedBody();
        #$data['user_id'] = $auth->user()->getId();

        $repository->update(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ], $data 
        );

        */

        $client = Backers\Models\Client::find( $id );
        $client->fill( $data );
        $client->save();

        return $app->route('clients.list');
    }, 'client.update'
);

$app->get(
    '/client/{id}/show', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        $id = $request->getAttribute('id');

        /*$repository = $app->service('category-cost.repository');
        $category = $repository->findOneBy(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ] 
        );
        */

        $client = Backers\Models\Client::find( $id );

        $view = $app->service('view.renderer');
        return $view->render('clients/show.html.twig', compact('client'));
    }, 'client.show'
);

$app->get(
    '/client/{id}/delete', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');
        $id = $request->getAttribute('id');

        /*$repository = $app->service('category-cost.repository');
        $repository->delete(
            [
            'id' => $id,
            'user_id' => $auth->user()->getId()
            ]
        );
        */

        $client = Backers\Models\Client::find( $id );
        $client->delete();

        return $app->route('clients.list');
    }, 'client.delete'
);