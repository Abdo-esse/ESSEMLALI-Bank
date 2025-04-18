<?php


namespace App\middlewares;

class AdminMiddleware {

    public function handle() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /ESSEMLALI-Bank/login");
            exit();
        }
    }
}