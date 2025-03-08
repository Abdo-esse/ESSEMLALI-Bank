<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSocket avec Ratchet</title>
</head>
<body>
    <h2>Chat WebSocket</h2>
    <input type="text" id="message" placeholder="Écris un message...">
    <button onclick="sendMessage()">Envoyer</button>
    <ul id="messages"></ul>

    <script>
        const socket = new WebSocket("ws://localhost:8080");

        socket.onopen = () => {
            console.log("Connecté au serveur WebSocket");
        };

        socket.onmessage = (event) => {
            const li = document.createElement("li");
            li.textContent = event.data;
            document.getElementById("messages").appendChild(li);
        };

        socket.onerror = (error) => {
            console.log("Erreur WebSocket", error);
        };

        function sendMessage() {
            const message = document.getElementById("message").value;
            socket.send(message);
        }
    </script>
</body>
</html>
