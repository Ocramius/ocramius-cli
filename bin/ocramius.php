#!/usr/bin/env php
<?php

use Ocramius\Console\Command\Help;
use Ocramius\Console\Symbol\Goodbye;
use Ocramius\Console\Symbol\Logo;
use Ocramius\Persister\File;
use Ocramius\Persister\Gist;
use Zend\Console\ColorInterface;
use Zend\Console\Console;
use Zend\Console\Prompt\Confirm;
use Zend\Http\Client;

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

$filePersister = new File(getcwd());
$gistPersister = new Gist(new Client());
$console       = Console::getInstance();
$logo          = new Logo();
$help          = new Help();
$goodbye       = new Goodbye();

$logo->draw($console);

$report = $help->help($console);

$file = $filePersister->persist($report);

$console->writeLine('The information has been saved to', ColorInterface::GREEN);
$console->writeLine(realpath($file), ColorInterface::BLACK, ColorInterface::CYAN);

$console->write('May I upload this information on https://gist.github.com/ ?', ColorInterface::CYAN);
$console->writeLine('[y/n]', ColorInterface::GREEN);

$prompt = new Confirm('');

$prompt->setConsole($console);

if ($prompt->show()) {
    $gistUri = $gistPersister->persist($report);

    $console->writeLine('The information was uploaded to', ColorInterface::GREEN);
    $console->writeLine($gistUri, ColorInterface::BLACK, ColorInterface::CYAN);
}

$goodbye->draw($console);
