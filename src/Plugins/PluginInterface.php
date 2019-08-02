<?php
declare(strict_types=1);
namespace Backers\Plugins;

use Backers\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}