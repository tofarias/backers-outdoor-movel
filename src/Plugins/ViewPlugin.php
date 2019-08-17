<?php
declare(strict_types=1);
namespace Backers\Plugins;

use Backers\ServiceContainerInterface;
use Backers\View\ViewRender;

use Backers\View\Twig\TwigGlobals;
use Interop\Container\Containerinterface;

class ViewPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy(
            'twig', function (Containerinterface $container) {
                $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../templates');
                $twig = new \Twig_Environment($loader);

                $generator = $container->get('routing.generator');

                $auth = $container->get('auth');
                $flashMessage = $container->get('flash_message');

                $twig->addExtension(new TwigGlobals($auth, $flashMessage));

                $twig->addFunction(
                    new \Twig_SimpleFunction(
                        'route', function (string $name, Array $params = []) use ($generator) {

                            return $generator->generate($name, $params);
                        }
                    )
                );

                return $twig;
            }
        );

        $container->addLazy(
            'view.renderer', function (Containerinterface $container) {
                $twigEnviroment = $container->get('twig');
                return new ViewRender($twigEnviroment);
            }
        );
    }
}