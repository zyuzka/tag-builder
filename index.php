<?php

use TagBuilder\App;

require 'vendor/autoload.php';

const APPLICATION_ROOT = __DIR__ . '/../../';

$action = $argv[1] ?? '';

try {
    (new App())->run($action);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;

    exit(1);
}
