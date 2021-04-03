#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/config/bootstrap.php';

use NapoleonCat\Kernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;

$kernel = new Kernel(getenv('APP_ENV'), (bool) getenv('APP_DEBUG'));
$application = new Application($kernel);
$application->run();