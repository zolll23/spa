<?php

declare(strict_types=1);

require_once(__DIR__ . '/../vendor/autoload.php');

use Spa\App;
use Spa\Config;
use VPA\DI\Container;

$config = new Config();
try {
    $di = new Container();
    $di->registerContainers($config->containers);
    $app = $di->get(App::class);
    $app->init();
    $app->bootstrap();
} catch (Throwable $e) {
    echo "<div style='color: red;'>{$e->getMessage()}<br>";
    while ($prev = $e->getPrevious()) {
        echo "{$prev->getMessage()}<br>";
        $e = $prev;
    }
    echo "</div>";
}
