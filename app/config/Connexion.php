<?php
namespace App\Config;

require dirname(__DIR__) . '/../vendor/autoload.php'; 

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Connexion
{
    private static $conn = null;

    static function connexion()
    {
        if (self::$conn === null) {
            try {
                
                $dotenv = Dotenv::createImmutable(dirname(__DIR__,2));
                $dotenv->load();

                
                $host = $_ENV['DB_HOST'] ;
                $db = $_ENV['DB_NAME'];
                $username = $_ENV['DB_USER'] ;
                $password = $_ENV['DB_PASSWORD'] ;

                
                self::$conn = new PDO("pgsql:host=$host;dbname=$db", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                echo "Connected to PostgreSQL"; 

            } catch (PDOException $exception) {
                die("Erreur de connexion : " . $exception->getMessage());
            }
        }
        return self::$conn;
    }
}
