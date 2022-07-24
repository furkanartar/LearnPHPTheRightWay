<?php

declare(strict_types = 1);

$rootDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $rootDirectory . 'app\\' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $rootDirectory . 'transaction_files\\' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $rootDirectory . 'views\\' . DIRECTORY_SEPARATOR);

include(VIEWS_PATH . 'transactions.php');