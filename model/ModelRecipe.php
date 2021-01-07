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
        public $SELECT = ("
            select r.id, r.lens_type, r.sphere_left, r.sphere_right, r.cylinder_left,
            r.cylinder_right, r.axis_left, r.axis_right, r.prism, r.base, f.name 'frame',
            m.material 'crystal_material', t.type 'crystal_type', r.pupillary_distance,
            r.lens_value, r.deliver_date, r.retirement_date, r.observation,
            c.rut 'rut_client', c.name 'name_client', c.phone 'phone_client',
            u.name 'name_user', r.state from recipe r inner join frame f on f.id = r.frame
            inner join  crystal_material m on m.id = crystal_material inner join
            crystal_type t on t.id = crystal_type inner join client c on
            c.rut = rut_client inner join users u on u.rut = rut_user where
            r.rut_client = :rut_client
        ");
        public $SELECT_ID = ("
            select r.id, r.lens_type, r.sphere_left, r.sphere_right, r.cylinder_left,
            r.cylinder_right, r.axis_left, r.axis_right, r.prism, r.base, f.name 'frame',
            m.material 'crystal_material', t.type 'crystal_type', r.pupillary_distance,
            r.lens_value, r.deliver_date, r.retirement_date, r.observation,
            c.rut 'rut_client', c.name 'name_client', c.phone 'phone_client',
            u.name 'name_user', r.state from recipe r inner join frame f on f.id = r.frame
            inner join  crystal_material m on m.id = crystal_material inner join
            crystal_type t on t.id = crystal_type inner join client c on
            c.rut = rut_client inner join users u on u.rut = rut_user where
            r.id = :id_recipe
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

            // return $assistant -> execute();
            echo $recipe;
        }

        public function readAll($rut_client) {
            $assistant = Connection::connector() -> prepare(
                $this -> SELECT
            );

            $assistant -> bindParam(
                ":rut_client", $rut_client
            );

            $assistant -> execute();

            return $assistant -> fetchAll(\PDO::FETCH_ASSOC);
        }

        public function readById($id_recipe) {
            $assistant = Connection::connector() -> prepare(
                $this -> SELECT_ID
            );

            $assistant -> bindParam(
                ":id_recipe", $id_recipe
            );

            $assistant -> execute();

            return $assistant -> fetchAll(\PDO::FETCH_ASSOC);
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