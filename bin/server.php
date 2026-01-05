<?php
require __DIR__ . '/../vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;
use Ratchet\RFC6455\Messaging\MessageInterface;

use Root\Html\model\ChatServer;

// Démarrage du serveur WebSocket sur le port 8080
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer()
        )
    ),
    8080
);

echo "Serveur WebSocket démarré sur ws://localhost:8080\n";
$server->run();
