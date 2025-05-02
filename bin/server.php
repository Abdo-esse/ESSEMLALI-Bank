<?php
require __DIR__ . '/../vendor/autoload.php';

use App\webSocket\TransactionServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;
use Ratchet\RFC6455\Messaging\MessageInterface;

// Démarrage du serveur WebSocket sur le port 8080
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new TransactionServer()
        )
    ),
    8080
);

echo "Serveur WebSocket démarré sur ws://localhost:8080\n";
$server->run();


// Demarrage partie front end 

// var conn = new WebSocket('ws://localhost:8080');
// conn.onopen = function(e) {
//     console.log("Connection established!");
// };

// conn.onmessage = function(e) {
//     console.log(e.data);
// };

// pour send 
// conn.send('Hello World!');