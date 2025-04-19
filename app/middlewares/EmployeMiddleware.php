<?php


namespace App\middlewares;

class EmployeMiddleware {

    public function handle() {
        session_start();
        if (!isset($_SESSION['user'])&& $_SESSION['user']["role"]=="Employé" ) {
            header("Location: /ESSEMLALI-Bank/login");
            exit();
        }
    }
}