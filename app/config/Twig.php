<?php
// config/config.php
require dirname(__DIR__) . '/../vendor/autoload.php'; 


use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('../app/views'); // Dossier où tu stockes tes templates
$twig = new Environment($loader, [
    'cache' => false,  // Pour le développement, tu peux désactiver le cache
]);

return $twig;
