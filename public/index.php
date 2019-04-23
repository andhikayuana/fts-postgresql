<?php

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$dotenv = Dotenv\Dotenv::create(dirname(__DIR__));
$dotenv->load();

$db = new \Yuana\Database(
    getenv('DB_DRIVER'),
    getenv('DB_HOST'),
    getenv('DB_PORT'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_DEBUG')
);

$app = new \Yuana\App($db);
$app->run();