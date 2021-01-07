<?php
    namespace controller;

    use model\ModelRecipe;
    require_once("../model/ModelRecipe.php");

    class NewRecipe {
        public $lens_type, $crystal_type, $crystal_material, $sphere_left, $sphere_right,
        $cylinder_left, $cylinder_right, $axis_left, $axis_right, $base, $frame,
        $prism, $pupillary_distance, $lens_value, $deliver_date, $retirement_date,
        $observation, $rut_client, $rut_doctor, $name_doctor;
        public $error = "";

        public function __construct() {
            $this -> lens_type = $_POST["lens_type"];
            $this -> crystal_type = $_POST["crystal_type"];
            $this -> crystal_material = $_POST["crystal_material"];
            $this -> sphere_left = $_POST["sphere_left"];
            $this -> sphere_right = $_POST["sphere_right"];
            $this -> cylinder_left = $_POST["cylinder_left"];
            $this -> cylinder_right = $_POST["cylinder_right"];
            $this -> axis_left = $_POST["axis_left"];
            $this -> axis_right = $_POST["axis_right"];
            $this -> base = $_POST["base"];
            $this -> prism = $_POST["prism"];
            $this -> frame = $_POST["frame"];
            $this -> pupillary_distance = $_POST["pupillary_distance"];
            $this -> lens_value = $_POST["lens_value"];
            $this -> deliver_date = $_POST["deliver_date"];
            $this -> retirement_date = $_POST["retirement_date"];
            $this -> observation = $_POST["observation"];
            $this -> rut_client = $_POST["rut_client"];
            $this -> rut_doctor = $_POST["rut_doctor"];
            $this -> name_doctor = $_POST["name_doctor"];
        }

        public function validate() {
            // if(isset($_POST["prism"])) {
            //     $this -> prism = 0;
            // }
            
            if(
                $this -> lens_type == "" && $this -> crystal_type == "" &&
                $this -> crystal_material == "" && $this -> sphere_left == "" &&
                $this -> sphere_right == "" && $this -> cylinder_left == "" &&
                $this -> cylinder_right == "" && $this -> axis_left == "" &&
                $this -> axis_right == "" && $this -> base == "" &&
                $this -> frame == "" && $this -> pupillary_distance == "" &&
                $this -> lens_value == "" && $this -> deliver_date == "" &&
                $this -> retirement_date == "" && $this -> observation == "" &&
                $this -> rut_client == "" && $this -> rut_doctor == "" &&
                $this -> name_doctor == ""
            ) {
                $this -> error = "Verifica los Campos";
            } else {
                if(
                    $this -> lens_type == "" || $this -> crystal_type == "" ||
                    $this -> crystal_material == "" || $this -> sphere_left == "" ||
                    $this -> sphere_right == "" || $this -> cylinder_left == "" ||
                    $this -> cylinder_right == "" || $this -> axis_left == "" ||
                    $this -> axis_right == "" || $this -> base == "" ||
                    $this -> frame == "" || $this -> deliver_date == "" ||
                    $this -> retirement_date == "" || $this -> observation == "" ||
                    $this -> rut_client == "" || $this -> rut_doctor == "" ||
                    $this -> name_doctor == ""
                ) {
                    $this -> error = "Los Campos Deben Estar Completos";
                } else {
                    if(
                        $this -> pupillary_distance == "" || 
                        $this -> pupillary_distance < 40 || 
                        $this -> pupillary_distance > 75
                    ) {
                        $this -> error = "Verifica el Rango de la Distancia Pupilar". "<br>";
                    }

                    if($this -> axis_left == "" || $this -> axis_left < 0 || $this -> axis_left > 180) {
                        $this -> error .= "Verifica el Eje del Ojo Izquierdo". "<br>";
                    }

                    if($this -> axis_right == "" || $this -> axis_right < 0 || $this -> axis_right > 180) {
                        $this -> error .= "Verifica el Eje del Ojo Derecho". "<br>";
                    }
    
                    if($this -> lens_value == "" || $this -> lens_value < 1) {
                        $this -> error .= "Verifica el Valor del Lente";
                    }
                }
            }
        }

        public function addRecipe() {
            $this -> validate();

            if($this -> error == "") {
                session_start();

                $modelRecipe = new ModelRecipe();
                $result = $modelRecipe -> create([
                    "lens_type" => $this -> lens_type,
                    "crystal_type" => $this -> crystal_type,
                    "crystal_material" => $this -> crystal_material,
                    "sphere_left" => $this -> sphere_left,
                    "sphere_right" => $this -> sphere_right,
                    "cylinder_left" => $this -> cylinder_left,
                    "cylinder_right" => $this -> cylinder_right,
                    "axis_left" => $this -> axis_left,
                    "axis_right" => $this -> axis_right,
                    "base" => $this -> base,
                    "frame" => $this -> frame,
                    "prism" => $this -> prism,
                    "pupillary_distance" => $this -> pupillary_distance,
                    "lens_value" => $this -> lens_value,
                    "deliver_date" => $this -> deliver_date,
                    "retirement_date" => $this -> retirement_date,
                    "observation" => $this -> observation,
                    "rut_client" => $this -> rut_client,
                    "rut_doctor" => $this -> rut_doctor,
                    "name_doctor" => $this -> name_doctor,
                    "rut_user" => $_SESSION["user"]["rut"]
                ]);

                if($result == 1) {
                    echo json_encode("La Receta Se Registro");
                } else {
                    echo json_encode("La Receta No Se Registro");
                }
            } else {
               echo json_encode($this -> error);
            }
        }
    }

    $object = new NewRecipe();
    $object -> addRecipe();
?>