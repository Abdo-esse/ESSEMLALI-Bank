<?php
require dirname(__DIR__) . '/../vendor/autoload.php'; 


use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('../app/views'); 
$twig = new Environment($loader, [
    'cache' => false, 
]);

return $twig;
