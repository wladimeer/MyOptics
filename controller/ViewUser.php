<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class ViewUser {

        public function view() {
            $modelUser = new ModelUser();
            $result = $modelUser -> read();

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

    $object = new ViewUser();
    $object -> view();
?>