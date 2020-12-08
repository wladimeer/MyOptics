<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class SearchUser {
        public $rut;

        public function __construct() {
            $this -> rut = $_POST["rut"];
        }

        public function search() {
            $modelUser = new ModelUser();
            $result = $modelUser -> search(
                $this -> rut
            );

            session_start();

            if(isset($_SESSION["user"])) {
                if(count($result) > 0) {
                    echo json_encode($result);
                } else {
                    echo json_encode("");
                }
            } else {
                echo json_encode("Acceso Denegado");
            }
        }
    }

    $object = new SearchUser();
    $object -> search();
?>