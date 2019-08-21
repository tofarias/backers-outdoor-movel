<?php

use \Psr\Http\Message\ServerRequestInterface;
use Illuminate\Database\Connection as DB;

$app->get(
    '/admin', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('admin/index.html.twig');
    }, 'admin.index'
);

$app->get(
    '/admin/clientes-pf', function (ServerRequestInterface $request) use ($app) {

        $docType = 'cpf';

        $date = new DateTime();

        $beginCreatedAt = $date->format('Y-m-d');

        $date->sub(new DateInterval('P5D'));
        $endCreatedAt = $date->format('Y-m-d');

        $data = $request->getQueryParams();

        $queryBuilder = \Backers\Models\Client::where('doc_type', $docType);
        $queryBuilder->orderBy('created_at', 'desc');

        if( isset($data['begin_created_at']) && !empty($data['begin_created_at']) ){
            if( isset($data['end_created_at']) && !empty($data['end_created_at']) ){

                $beginCreatedAt = $data['begin_created_at'];
                $endCreatedAt = $data['end_created_at'];

                $queryBuilder->whereRaw("date(created_at) >= '".$data['begin_created_at']."'");
                $queryBuilder->whereRaw("date(created_at) <= '".$data['end_created_at']."'");
            }
        }else{
            $queryBuilder->whereRaw("date(created_at) >= '".$beginCreatedAt."'");
            $queryBuilder->whereRaw("date(created_at) <= '".$endCreatedAt."'");
        }

        $clients = $queryBuilder->get();

        $view = $app->service('view.renderer');
        return $view->render('admin/clients/list-pf.html.twig', compact('clients', 'docType', 'beginCreatedAt', 'endCreatedAt'));
    }, 'clients.list-pf'
);

$app->get(
    '/admin/clientes-pj', function (ServerRequestInterface $request) use ($app) {

        $docType = 'cnpj';

        $date = new DateTime();

        $beginCreatedAt = $date->format('Y-m-d');

        $date->sub(new DateInterval('P5D'));
        $endCreatedAt = $date->format('Y-m-d');

        $data = $request->getQueryParams();

        $queryBuilder = \Backers\Models\Client::where('doc_type', $docType);
        $queryBuilder->orderBy('created_at', 'desc');

        if( isset($data['begin_created_at']) && !empty($data['begin_created_at']) ){
            if( isset($data['end_created_at']) && !empty($data['end_created_at']) ){

                $beginCreatedAt = $data['begin_created_at'];
                $endCreatedAt = $data['end_created_at'];

                $queryBuilder->whereRaw("date(created_at) >= '".$data['begin_created_at']."'");
                $queryBuilder->whereRaw("date(created_at) <= '".$data['end_created_at']."'");
            }
        }else{
            $queryBuilder->whereRaw("date(created_at) >= '".$beginCreatedAt."'");
            $queryBuilder->whereRaw("date(created_at) <= '".$endCreatedAt."'");
        }

        $clients = $queryBuilder->get();

        $view = $app->service('view.renderer');
        return $view->render('admin/clients/list-pj.html.twig', compact('clients', 'docType', 'beginCreatedAt', 'endCreatedAt'));
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

        $id = $request->getAttribute('id');

        $repository = $app->service('client.repository');
        $client = $repository->findOneBy(
            [
            'id' => $id
            ]
        );

        $view = $app->service('view.renderer');
        return $view->render('admin/clients/show.html.twig', compact('client'));
    }, 'client.show'
);

$app->post(
    '/admin/editar-texto-empresa', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

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