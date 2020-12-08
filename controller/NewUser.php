<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class NewUser {
        public $rut, $name, $state;
        public $error = "";

        public function __construct() {
            $this -> rut = $_POST["rut"];
            $this -> name = $_POST["name"];
            $this -> state = $_POST["state"];
        }
        
        public function validate() {
            if($this -> rut == "" && $this -> name == "" && $this -> state == "") {
                $this -> error = "Verifica los Campos";
            } else {
                if($this -> rut == "") {
                    $this -> error = "Verifica el Rut del Usuario". "<br>";
                }

                if($this -> name == "") {
                    $this -> error .= "Verifica el Nombre del Usuario". "<br>";
                }

                if($this -> state == "") {
                    $this -> error .= "Selecciona un Estado al Usuario";
                }
            }
        }

        public function addUser() {
            $this -> validate();
            
            if($this -> error == "") {
                $modelUser = new ModelUser();
                $result = $modelUser -> search($this -> rut);

                if(count($result) > 0) {
                    echo json_encode("El Rut Está Registrado");
                } else {
                    $user = [
                        "rut" => $this -> rut,
                        "name" => $this -> name,
                        "role" => "Usuario",
                        "password" => md5("123456"),
                        "state" => $this -> state
                    ];

                    $result = $modelUser -> create($user);
                    
                    if($result) {
                        echo json_encode("El Usuario Se Registro");
                    } else {
                        echo json_encode("El Usuario No Se Registro");
                    }
                }
            } else {
                echo json_encode($this -> error);
            }     
        }
    }

    $object = new NewUser();
    $object -> addUser();
?>