<?php

use \Psr\Http\Message\ServerRequestInterface;

$app->get(
    '/', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('site/index.html.twig', []);
    }, 'site.index'
);

$app->get(
    '/contato', function (ServerRequestInterface $request) use ($app) {

        $view = $app->service('view.renderer');
        return $view->render('site/contact.html.twig', []);
    }, 'site.contact'
);

$app->post(
    '/contato/enviar-mensagem', function (ServerRequestInterface $request) use ($app) {

        $mail = $app->service('mail');

        if (!$mail->send()) {
            echo '<pre>';
            echo "Mailer Error: " . $mail->ErrorInfo;
            echo '</pre>';
        } else {
            echo "Message sent!";
        }

        dd( $mail );

        $view = $app->service('view.renderer');
        return $view->render('site/contact.html.twig', []);
    }, 'site.contact.message.send'
);