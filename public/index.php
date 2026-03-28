<?php

/**
 * CodeIgniter 4 - Front Controller
 */

// Path to the front controller
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

// Load the paths config file
$pathsPath = FCPATH . '../app/Config/Paths.php';

require realpath($pathsPath) ?: $pathsPath;

$paths = new Config\Paths();

// Location of the framework bootstrap file
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

$app = require realpath($bootstrap) ?: $bootstrap;

// Launch the application
$app->run();
