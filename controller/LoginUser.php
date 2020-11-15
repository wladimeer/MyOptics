<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class LoginUser {
        public $rut, $password;
        public $error = "";

        public function __construct(){
            $this -> rut = $_POST["rut"];
            $this -> password = $_POST["password"];
        }

        public function validate() {
            if($this -> rut == "" && $this -> password == "") {
                $this -> error = "Verifica los Campos";
            } else {
                if($this -> rut == "") {
                    $this -> error = "Verifica el Rut";
                }
                
                if($this -> password == "") {
                    $this -> error = "Verifica la Contraseña";
                }
            }
        }

        public function login() {
            $this -> validate();

            if($this -> error == "") {
                $modelUser = new ModelUser();
                $result = $modelUser -> search(
                    $this -> rut
                );

                if(count($result) == 0) {
                    echo json_encode("El Usuario no está Registrado");
                } else {
                    if(md5($this -> password) != $result[0]["password"]) {
                        echo json_encode("La Contraseña no Coincide");
                    } else {
                        session_start();
                        
                        if($result[0]["role"] == "Administrador") {
                            $_SESSION["user"] = $result[0];
                            header("Location: ../userManager.php");
                        } else if($result[0]["role"] == "Usuario") {
                            $_SESSION["user"] = $result[0];
                            header("Location: ../clientManager.php");
                        }
                    }
                } 
            } else {
                echo json_encode($this -> error);
            }
        }
    }

    $object = new LoginUser();
    $object -> login();
?>