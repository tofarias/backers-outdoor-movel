<?php
declare(strict_types=1);
namespace Backers\Plugins;

use PHPMailer\PHPMailer\PHPMailer;
use Backers\ServiceContainerInterface;
use Psr\Container\ContainerInterface;

class SendMailPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $mail = new PHPMailer(false);

        $mail->isSMTP( env('IS_SMTP') );
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = env('SMTP_DEBUG');

        $mail->Host = env('HOST');

        $mail->Port = env('PORT');

        $mail->SMTPSecure = env('SMTP_SECURE');

        $mail->SMTPAuth = env('SMTP_AUTH');

        $mail->Username = env('USERNAME');

        $mail->Password = 'PASSWORD';

        $mail->setFrom(env('FROM_EMAIL'), env('FROM_NAME'));
        //Set an alternative reply-to address
        //$mail->addReplyTo('replyto@example.com', 'First Last');
        //Set who the message is to be sent to
        $mail->addAddress(env('TO_EMAIL'), env('TO_NAME'));

        $mail->Subject = env('SUBJECT');

        $mail->isHTML( env('IS_HTML') );

        $container->addLazy(
            'mail', function (ContainerInterface $container) use ($mail) {
                return $mail;
            }
        );
    }
}