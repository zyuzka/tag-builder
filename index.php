<?php

use TagBuilder\App;

require 'vendor/autoload.php';

const APPLICATION_ROOT = __DIR__ . '/../../';

(new App())->run($argv);
