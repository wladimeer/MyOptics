<?php
    namespace connection;

    class Connection {
        public static $user = "root";
        public static $pass = "root";
        public static $url = (
            "mysql:host=localhost;dbname=optics"
        );

        public static function connector() {
            try {
                return new \PDO(
                    Connection::$url,
                    Connection::$user,
                    Connection::$pass
                );
            } catch (\PDOException $exception) {
                echo $exception;
            }
        }
    }
?>