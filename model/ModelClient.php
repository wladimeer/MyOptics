<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelClient {
        public $INSERT = "insert into client values(:rut, :name, :address, :phone, :date, :email)";
        public $SELECT = "select * from client where rut = :rut";

        public function create($client) {
            $assistant = Connection::connector() -> prepare(
                $this -> INSERT
            );

            $assistant -> bindParam(
                ":rut", $client["rut"]
            );

            $assistant -> bindParam(
                ":name", $client["name"]
            );

            $assistant -> bindParam(
                ":address", $client["address"]
            );

            $assistant -> bindParam(
                ":phone", $client["phone"]
            );

            $assistant -> bindParam(
                ":date", $client["date"]
            );

            $assistant -> bindParam(
                ":email", $client["email"]
            );

            return $assistant -> execute();
        }

        public function read($rut) {
            $assistant = Connection::connector() -> prepare(
                $this -> SELECT
            );

            $assistant -> bindParam(
                ":rut", $rut
            );

            $assistant -> execute();

            return $assistant -> fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>