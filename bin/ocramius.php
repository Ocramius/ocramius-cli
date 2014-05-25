#!/usr/bin/env php
<?php

use Ocramius\Console\Command\Help;
use Ocramius\Console\Symbol\Goodbye;
use Ocramius\Console\Symbol\Logo;
use Zend\Console\Console;

$files = [
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php',
    __DIR__ . '/../../../vendor/autoload.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $loader = require $file;

        break;
    }
}

if (! isset($loader)) {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

$console = Console::getInstance();
$logo    = new Logo();
$help    = new Help();
$goodbye = new Goodbye();

$logo->draw($console);

$report = $help->help($console);

$goodbye->draw($console);

var_dump($report);
