<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelRecipe {
        public $INSERT = ("
            insert into recipe values(
                null, :lens_type, :crystal_type, :crystal_material, :sphere_left,
                :sphere_right, :cylinder_left, :cylinder_right, :axis_left, :axis_right,
                :base, :frame, :prism, :pupillary_distance, :lens_value, :deliver_date,
                :retirement_date, :observation, :rut_client, :rut_doctor, :name_doctor,
                :rut_user, 1
            )
        ");
        public $SELECT_RUT = "select id, lens_type, deliver_date from recipe where rut_client like :rut_client";
        public $SELECT_DATE = "select id, lens_type, deliver_date from recipe where deliver_date like :deliver_date";
        
        public function create($recipe) {
            $assistant = Connection::connector() -> prepare(
                $this -> INSERT
            );

            $assistant -> bindParam(
                ":lens_type", $recipe["lens_type"]
            );

            $assistant -> bindParam(
                ":crystal_type", $recipe["crystal_type"]
            );

            $assistant -> bindParam(
                ":crystal_material", $recipe["crystal_material"]
            );

            $assistant -> bindParam(
                ":sphere_left", $recipe["sphere_left"]
            );

            $assistant -> bindParam(
                ":sphere_right", $recipe["sphere_right"]
            );

            $assistant -> bindParam(
                ":cylinder_left", $recipe["cylinder_left"]
            );

            $assistant -> bindParam(
                ":cylinder_right", $recipe["cylinder_right"]
            );

            $assistant -> bindParam(
                ":axis_left", $recipe["axis_left"]
            );

            $assistant -> bindParam(
                ":axis_right", $recipe["axis_right"]
            );

            $assistant -> bindParam(
                ":base", $recipe["base"]
            );

            $assistant -> bindParam(
                ":frame", $recipe["frame"]
            );

            $assistant -> bindParam(
                ":prism", $recipe["prism"]
            );

            $assistant -> bindParam(
                ":pupillary_distance", $recipe["pupillary_distance"]
            );

            $assistant -> bindParam(
                ":lens_value", $recipe["lens_value"]
            );

            $assistant -> bindParam(
                ":deliver_date", $recipe["deliver_date"]
            );

            $assistant -> bindParam(
                ":retirement_date", $recipe["retirement_date"]
            );

            $assistant -> bindParam(
                ":observation", $recipe["observation"]
            );

            $assistant -> bindParam(
                ":rut_client", $recipe["rut_client"]
            );

            $assistant -> bindParam(
                ":rut_doctor", $recipe["rut_doctor"]
            );

            $assistant -> bindParam(
                ":name_doctor", $recipe["name_doctor"]
            );

            $assistant -> bindParam(
                ":rut_user", $recipe["rut_user"]
            );

            return $assistant -> execute();
        }

        public function readByRut($rut_client) {
            $assistant = Connection::connector() -> prepare(
                $this -> SELECT_RUT
            );

            $rut_client = $rut_client. "%";

            $assistant -> bindParam(
                ":rut_client", $rut_client
            );

            $assistant -> execute();

            return $assistant -> fetchAll(\PDO::FETCH_ASSOC);
        }

        public function readByDate($deliver_date) {
            $assistant = Connection::connector() -> prepare(
                $this -> SELECT_DATE
            );

            $deliver_date = $deliver_date. "%";

            $assistant -> bindParam(
                ":deliver_date", $deliver_date
            );

            $assistant -> execute();

            return $assistant -> fetchAll(\PDO::FETCH_ASSOC);
        }
    }
?>