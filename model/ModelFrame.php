<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelFrame {
        public $SELECT = "select * from frame";

        public function read() {
            $assitant = Connection::connector() -> prepare(
                $this -> SELECT
            );

            $assitant -> execute();

            return $assitant -> fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>