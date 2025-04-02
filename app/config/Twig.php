<?php
require dirname(__DIR__) . '/../vendor/autoload.php'; 

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;
use \Twig\TwigFunction;

// Create a new Twig loader and environment
$loader = new FilesystemLoader('../app/views'); 
$twig = new Environment($loader, [
    'cache' => false, 
]);

// Register the asset() function
$twig->addFunction(new \Twig\TwigFunction('asset', function ($path) {
    // Ensure the correct path from the public folder
    return '/uploads/' . ltrim($path, '/');
}));


// Return the configured Twig instance
return $twig;
