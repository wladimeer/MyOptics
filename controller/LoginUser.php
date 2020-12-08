<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class LoginUser {
        public $rut, $password;
        public $error = "";

        public function __construct() {
            $this -> rut = $_POST["rut"];
            $this -> password = $_POST["password"];
        }

        public function validate() {
            if($this -> rut == "" && $this -> password == "") {
                $this -> error = "Verifica los Campos";
            } else {
                if($this -> rut == "") {
                    $this -> error = "Verifica el Rut del Usuario";
                }
                
                if($this -> password == "") {
                    $this -> error = "Verifica la Contraseña del Usuario";
                }
            }
        }

        public function login() {
            $this -> validate();

            if($this -> error == "") {
                $modelUser = new ModelUser();
                $result = $modelUser -> search($this -> rut);

                if(count($result) == 0) {
                    echo json_encode(["message" => "El Usuario No está Registrado"]);
                } else {
                    if(md5($this -> password) != $result[0]["password"]) {
                        echo json_encode(["message" => "La Contraseña No Coincide"]);
                    } else {
                        if($result[0]["state"] == 1) {
                            session_start();
                        
                            if($result[0]["role"] == "Administrador") {
                                $_SESSION["user"] = $result[0];
                                echo json_encode(["success" => "Administrador"]);
                            } else if($result[0]["role"] == "Usuario") {
                                $_SESSION["user"] = $result[0];
                                echo json_encode(["success" => "Usuario"]);
                            }
                        } else {
                            echo json_encode(["message" => "El Usuario Está Desabilitado"]);
                        }
                    }
                }
            } else {
                echo json_encode(["message" => $this -> error]);
            }
        }
    }

    $object = new LoginUser();
    $object -> login();
?>