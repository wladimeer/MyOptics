<?php
    namespace controller;

    use model\ModelClient;
    require_once("../model/ModelClient.php");

    class SearchClient {
        public $rut;

        public function __construct() {
            $this -> rut = $_POST["rut"];
        }

        public function search() {
            $modelClient = new ModelClient();
            $result = $modelClient -> search($this -> rut);

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

    $object = new SearchClient();
    $object -> search();
?>