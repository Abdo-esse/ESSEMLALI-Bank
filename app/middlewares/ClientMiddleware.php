<?php


namespace App\middlewares;

class ClientMiddleware {

    public function handle() {
        session_start();
        if (!isset($_SESSION['user'])|| $_SESSION['user']["role"]!=="Client" ) {
            header("Location: /ESSEMLALI-Bank/login");
            exit();
        }
    }
}