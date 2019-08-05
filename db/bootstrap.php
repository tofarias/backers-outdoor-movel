<?php

use Backers\Application;
use Backers\Plugins\AuthPlugin;
use Backers\Plugins\DbPlugin;
use Backers\ServiceContainer;

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

return $app;