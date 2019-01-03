<?php

define('PROJECT_ROOT', __DIR__ . '/../');

require PROJECT_ROOT . 'vendor/autoload.php';

session_start();

// Load .env file
$dotenv = \Dotenv\Dotenv::create(PROJECT_ROOT);
$dotenv->load();

// Instantiate the app
$settings = require PROJECT_ROOT . 'src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require PROJECT_ROOT . 'src/dependencies.php';

// Register middleware
require PROJECT_ROOT . 'src/middleware.php';

// Register routes
require PROJECT_ROOT . 'src/routes.php';

// Run app
$app->run();