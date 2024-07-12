<?php
class Connexion {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            $servername = "localhost";
            $username = "mglsi_user";
            $password = "passer";
            $dbname = "mglsi_news";

            
            try {
                self::$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
?>
