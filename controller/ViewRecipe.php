<?php
    namespace controller;

    use model\ModelRecipe;
    require_once("../model/ModelRecipe.php");

    class ViewRecipe {
        
        public function view() {
            session_start();

            if(isset($_SESSION["user"])) {
                $modelRecipe = new ModelRecipe();

                if(isset($_POST["rut"])) {
                    $result = $modelRecipe -> readByRut(
                        $_POST["rut"]
                    );

                    echo json_encode($result);
                } else if(isset($_POST["date"])) {
                    $result = $modelRecipe -> readByDate(
                        $_POST["date"]
                    );

                    echo json_encode($result);
                } else {
                    echo json_encode("");
                }
            } else {
                echo json_encode("Acceso Denegado");
            }
        }

    }

    $object = new ViewRecipe();
    $object -> view();
?>