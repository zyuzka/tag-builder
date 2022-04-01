<?php

use TagBuilder\App;

require 'vendor/autoload.php';

const APPLICATION_ROOT = __DIR__ . '/../../';

$action = $argv[1] ?? '';

(new App())->run($action);
