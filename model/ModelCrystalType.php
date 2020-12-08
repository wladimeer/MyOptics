<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelCrystalType {
        public $SELECT = "select * from crystal_type";

        public function read() {
            $assitant = Connection::connector() -> prepare(
                $this -> SELECT
            );

            $assitant -> execute();

            return $assitant -> fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>