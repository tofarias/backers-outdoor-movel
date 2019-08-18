<?php

use \Psr\Http\Message\ServerRequestInterface;

$app->get(
    '/admin', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('admin/index.html.twig');
    }, 'admin.index'
);

$app->get(
    '/admin/clientes-pf', function (ServerRequestInterface $request) use ($app) {

        $clients = \Backers\Models\Client::where('doc_type', 'cpf')->orderBy('created_at', 'desc')->get();

        $docType = 'cpf';

        $view = $app->service('view.renderer');
        return $view->render('admin/clients/list-pf.html.twig', compact('clients', 'page', 'docType'));
    }, 'clients.list-pf'
);

$app->get(
    '/admin/clientes-pj', function (ServerRequestInterface $request) use ($app) {

        $clients = \Backers\Models\Client::where('doc_type', 'cnpj')->orderBy('created_at', 'desc')->get();
        
        $docType = 'cnpj';

        $view = $app->service('view.renderer');
        return $view->render('admin/clients/list-pj.html.twig', compact('clients', 'page', 'docType'));
    }, 'clients.list-pj'
);

$app->get(
    '/admin/cliente/{id}/delete', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {
        
        $id = $request->getAttribute('id');

        $repository = $app->service('client.repository');

        $client = $repository->findOneBy(['id' => $id]);
        $route = $client->doc_type == 'cpf' ? 'clients.list-pf' : 'clients.list-pj' ;

        $repository->delete(
            [
            'id' => $id
            ]
        );

        $flash = $app->service('flash_message');
        $flash->success('Registro removido com sucesso!');        

        return $app->route( $route );
    }, 'client.delete'
);

$app->get(
    '/admin/cliente/{id}/show', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

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
        return $view->render('admin/clients/show.html.twig', compact('client'));
    }, 'client.show'
);

$app->post(
    '/admin/editar-texto-empresa', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $data = $request->getParsedBody();

        $repository = $app->service('site.repository');

        $data = $request->getParsedBody();

        $repository->update(
            [
            'id' => 1
            ], $data
        );

        $flash = $app->service('flash_message');
        $flash->success('Registro salvo com sucesso!');

        return $app->route('site.about.edit');

    },'site.about.save'
);

$app->get(
    '/admin/editar-texto-empresa', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {
        
        $repository = $app->service('site.repository');
        $site = $repository->findOneBy(
            [
            'id' => 1
            ]
        );

        $view = $app->service('view.renderer');
        return $view->render('admin/texto.html.twig', compact('site'));

    }, 'site.about.edit'
);