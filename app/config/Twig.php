<?php
require dirname(__DIR__) . '/../vendor/autoload.php'; 

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;
use \Twig\TwigFunction;


$loader = new FilesystemLoader('../app/views'); 
$twig = new Environment($loader, [
    'cache' => false, 
]);

$twig->addFunction(new \Twig\TwigFunction('asset', function ($path) {
    return '/ESSEMLALI-Bank/public/' . ltrim($path, '/');
}));


return $twig;
