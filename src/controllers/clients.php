<?php

use \Psr\Http\Message\ServerRequestInterface;

$app->get(
    '/clientes-pf', function (ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        #$repository = $app->service('client.repository');
        #$clients = $repository->all();

        #$data = $request->getParsedBody();
        //$page = $request->getQueryParams()['page'];
        #dd( $request->getQueryParams()['page'] );
        //$data['page'] = $auth->user()->getId();

        $limit = 10;

        if( isset($request->getQueryParams()['page']) ){
            $page = $request->getQueryParams()['page'];
            $offset = $page +1;
        }else{
            $offset = 0;
            $page = 0;
        }

        $clients = \Backers\Models\Client::where('doc_type', 'cpf')->orderBy('created_at', 'desc')->get();
        #$clients = \Backers\Models\Client::skip( $page )->take(2)->get();
        #$clients = \Backers\Models\Client::offset( $offset )->limit( $limit )->get();

        $docType = 'cpf';

        $view = $app->service('view.renderer');
        return $view->render('clients/list-pf.html.twig', compact('clients', 'page', 'docType'));
    }, 'clients.list-pf'
);

$app->get(
    '/clientes-pj', function (ServerRequestInterface $request) use ($app) {

        #$auth = $app->service('auth');

        #$repository = $app->service('client.repository');
        #$clients = $repository->all();

        #$data = $request->getParsedBody();
        //$page = $request->getQueryParams()['page'];
        #dd( $request->getQueryParams()['page'] );
        //$data['page'] = $auth->user()->getId();

        $limit = 10;

        if( isset($request->getQueryParams()['page']) ){
            $page = $request->getQueryParams()['page'];
            $offset = $page +1;
        }else{
            $offset = 0;
            $page = 0;
        }

        $clients = \Backers\Models\Client::where('doc_type', 'cnpj')->orderBy('created_at', 'desc')->get();
        #$clients = \Backers\Models\Client::skip( $page )->take(2)->get();
        #$clients = \Backers\Models\Client::offset( $offset )->limit( $limit )->get();
        $docType = 'cnpj';

        $view = $app->service('view.renderer');
        return $view->render('clients/list-pj.html.twig', compact('clients', 'page', 'docType'));
    }, 'clients.list-pj'
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

        $client = $repository->findOneBy(['id' => $id]);
        $route = $client->doc_type == 'cpf' ? 'clients.list-pf' : 'clients.list-pj' ;

        $repository->delete(
            [
            'id' => $id,
            #'user_id' => $auth->user()->getId()
            ]
        );

        

        return $app->route( $route );
    }, 'client.delete'
);