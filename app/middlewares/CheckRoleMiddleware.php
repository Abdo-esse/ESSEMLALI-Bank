<?php


namespace App\middlewares;

class CheckRoleMiddleware {
    public function handle() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit();
        }
    }
}