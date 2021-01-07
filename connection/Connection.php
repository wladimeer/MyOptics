<?php
    namespace connection;

    class Connection {
        public static $user = "urg27nqzrot3ug0l";
        public static $pass = "pEjEgd5nUQTrIBt4Thvj";
        public static $url = (
            "mysql:host=b8tve1glw1p6tob8qnqz-mysql.services.clever-cloud.com;dbname=b8tve1glw1p6tob8qnqz"
        );

        public static function connector() {
            try {
                return new \PDO(
                    Connection::$url,
                    Connection::$user,
                    Connection::$pass
                );
            } catch (\PDOException $exception) {
                echo null;
            }
        }
    }
?>