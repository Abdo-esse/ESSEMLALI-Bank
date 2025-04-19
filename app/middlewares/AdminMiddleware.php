<?php


namespace App\middlewares;

class AdminMiddleware {

    public function handle() {
        session_start();
        if (!isset($_SESSION['user'])&& $_SESSION['user']["role"]=="Admin" ) {
            header("Location: /ESSEMLALI-Bank/login");
            exit();
        }
    }
}