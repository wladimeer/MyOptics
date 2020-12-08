<?php
    namespace controller;

    use model\ModelCrystalType;
    require_once("../model/ModelCrystalType.php");

    class ViewCrystalType {

        public function view() {
            $modelCrystalType = new ModelCrystalType();
            $result = $modelCrystalType -> read();

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

    $object = new ViewCrystalType();
    $object -> view();
?>