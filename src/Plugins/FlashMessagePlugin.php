<?php
declare(strict_types=1);
namespace Backers\Plugins;

use Backers\ServiceContainerInterface;
use Backers\View\ViewRender;

use Backers\View\Twig\TwigGlobals;
use Interop\Container\Containerinterface;

class FlashMessagePlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy(
            'flash_message', function (Containerinterface $container) {
                return new \Plasticbrain\FlashMessages\FlashMessages();
            }
        );
    }
}