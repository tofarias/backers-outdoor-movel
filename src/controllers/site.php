<?php

use \Psr\Http\Message\ServerRequestInterface;

$app->get(
    '/', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('site/index.html.twig', []);
    }, 'site.index'
);

$app->get(
    '/empresa', function (ServerRequestInterface $request) use ($app) {

        $repository = $app->service('site.repository');
        $site = $repository->findOneBy(
            [
            'id' => 1
            ]
        );

        $view = $app->service('view.renderer');
        return $view->render('site/about.html.twig', compact('site'));
    }, 'site.about'
);

$app->get(
    '/cliente/cadastrar', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('site/register.html.twig', []);
    }, 'site.cliente.cadastrar'
);

$app->post(
    '/cliente/salvar', function (\Psr\Http\Message\ServerRequestInterface $request) use ($app) {

        $data = $request->getParsedBody();

        $repository = $app->service('client.repository');
        $repository->create($data);

        $flash = $app->service('flash_message');
        $flash->success('Dados enviados com sucesso!');

        return $app->route('site.cliente.cadastrar');
    }, 'site.cliente.post.cadastrar'
);

$app->get(
    '/contato', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('site/contact.html.twig', []);
    }, 'site.contact'
);

$app->post(
    '/contato/enviar-mensagem', function (ServerRequestInterface $request) use ($app) {

        $data = $request->getParsedBody();

        $mensagem = '';

        if( isset($data['name']) && !empty($data['name']) ){
            $mensagem .= '<tr><td>';
            $mensagem .= "<b>Nome:</b> <br>".$data['name'];
            $mensagem .= '</td></tr>';
        }
        if( isset($data['email']) && !empty($data['email']) ){
            $mensagem .= '<tr><td>';
            $mensagem .= "<b>E-mail:</b> <br>".$data['email'];
            $mensagem .= '</td></tr>';
        }
        if( isset($data['phone']) && !empty($data['phone']) ){
            $mensagem .= '<tr><td>';
            $mensagem .= "<b>Telefone:</b> <br>".$data['phone'];
            $mensagem .= '</td></tr>';
        }
        if( isset($data['address']) && !empty($data['address']) ){
            $mensagem .= '<tr><td>';
            $mensagem .= "<b>Endereço:</b> <br>".$data['address'];
            $mensagem .= '</td></tr>';
        }
        if( isset($data['subject']) && !empty($data['subject']) ){
            $mensagem .= '<tr><td>';
            $mensagem .= "<b>Assunto:</b> <br>".$data['subject'];
            $mensagem .= '</td></tr>';
        }
        if( isset($data['message']) && !empty($data['message']) ){
            $mensagem .= '<tr><td>';
            $mensagem .= "<b>Mensagem:</b> <br><pre>".$data['message']."</pre>";
            $mensagem .= '</td></tr>';
        }

        $mail = $app->service('mail');

        $mail->Subject = env('SUBJECT', 'NOVA MENSAGEM DO FORMULÁRIO DE CONTATO');
        $mail->Body    = $mensagem;

        if (!$mail->send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            //echo 'Ok';
        }

        //$view = $app->service('view.renderer');
        //return $view->render('site/contact.html.twig', []);

        return $app->redirect('/contato');

    }, 'site.contact.message.send'
);