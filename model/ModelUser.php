<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelUser {
        public $INSERT = "insert into users values(:rut, :name, :role, :password, :state)";
        public $UPDATE = "update users set state = :state where rut = :rut";
        public $SELECT = "select * from users where role = 'Usuario'";
        public $SEARCH = "select * from users where rut = :rut";

        public function create($user) {
            $assistant = Connection::connector() -> prepare(
                $this -> INSERT
            );

            $assistant -> bindParam(
                ":rut", $user["rut"]
            );

            $assistant -> bindParam(
                ":name", $user["name"]
            );

            $assistant -> bindParam(
                ":role", $user["role"]
            );

            $assistant -> bindParam(
                ":password", $user["password"]
            );

            $assistant -> bindParam(
                ":state", $user["state"]
            );

            return $assistant -> execute();
        }

        public function read() {
            $assistant = Connection::connector() -> prepare(
                $this -> SELECT
            );

            $assistant -> execute();

            return $assistant -> fetchAll(\PDO::FETCH_ASSOC);
        }

        public function update($state, $rut) {
            $assistant = Connection::connector() -> prepare(
                $this -> UPDATE
            );

            $assistant -> bindParam(
                ":state", $state
            );

            $assistant -> bindParam(
                ":rut", $rut
            );

            $assistant -> bindParam(
                ":rut", $rut
            );

            return $assistant -> execute();
        }

        public function search($rut) {
            $assistant = Connection::connector() -> prepare(
                $this -> SEARCH
            );

            $assistant -> bindParam(
                ":rut", $rut
            );

            $assistant -> execute();

            return $assistant -> fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>