<?php

namespace Backers\View\Twig;

use Backers\Auth\AuthInterface;
use Plasticbrain\FlashMessages\FlashMessages;

class TwigGlobals extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * @var AuthInterface
     */
    private $auth;
    private $flashMessage;


    /**
     * TwigGlobals constructor.
     */
    public function __construct(AuthInterface $auth, FlashMessages $flashMessage)
    {
        $this->auth = $auth;
        $this->flashMessage = $flashMessage;
    }

    public function getGlobals()
    {
        return [
            'Auth' => $this->auth,
            'Message' => $this->flashMessage
        ];
    }
}