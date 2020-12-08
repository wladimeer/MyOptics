<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelCrystalMaterial {
        public $SELECT = "select * from crystal_material";

        public function read() {
            $assitant = Connection::connector() -> prepare(
                $this -> SELECT
            );

            $assitant -> execute();

            return $assitant -> fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>