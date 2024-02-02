<?php
// Start Session
session_start();

// Include Config
require('config.php');

require('./src/classes/bootstrap.php');
require('./src/classes/controller.php');
require('./src/classes/model.php');

require('./src/controllers/home.php');
require('./src/controllers/lists.php');

require('./src/models/home.php');
require('./src/models/lists.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$_GET['controller'] = $uri[1];
$_GET['action'] = $uri[2];
$_GET['id'] = $uri[3];

$bootstrap = new Bootstrap($_GET); // Get all url parameters
$controller = $bootstrap->getController();

if ($controller) {
    $controller->executeAction();
}
