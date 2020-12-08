<?php
    namespace controller;

    use model\ModelClient;
    require_once("../model/ModelClient.php");

    class NewClient {
        public $rut, $name, $address, $phone, $date, $email;
        public $error = "";

        public function __construct() {
            $this -> rut = $_POST["rut"];
            $this -> name = $_POST["name"];
            $this -> address = $_POST["address"];
            $this -> phone = $_POST["phone"];
            $this -> date = $_POST["date"];
            $this -> email = $_POST["email"];
        }

        public function validate() {
            if(
                $this -> rut == "" && $this -> name == "" && 
                $this -> address == "" && $this -> phone == "" && 
                $this -> date == "" && $this -> email == ""
            ) {
                $this -> error = "Verifica los Campos";
            } else {
                if($this -> rut == "") {
                    $this -> error = "Verifica el Rut del Cliente". "<br>";
                }

                if($this -> name == "") {
                    $this -> error .= "Verifica el Nombre del Cliente". "<br>";
                }

                if($this -> address == "") {
                    $this -> error .= "Verifica la Dirección del Cliente". "<br>";
                }

                if($this -> phone == "") {
                    $this -> error .= "Verifica el Telefono del Cliente". "<br>";
                }

                if($this -> date == "") {
                    $this -> error .= "Selecciona la Fecha al Cliente". "<br>";
                }

                if($this -> email == "") {
                    $this -> error .= "Verifica el Correo del Cliente";
                }
            }
        }

        public function addClient() {
            $this -> validate();
            
            if($this -> error == "") {
                $modelClient = new ModelClient();
                $result = $modelClient -> read($this -> rut);

                if(count($result) > 0) {
                    echo json_encode("El Rut Ingresado Está Registrado");
                } else {
                    $client = [
                        "rut" => $this -> rut,
                        "name" => $this -> name,
                        "address" => $this -> address,
                        "phone" => $this -> phone,
                        "date" => $this -> date,
                        "email" => $this -> email
                    ];

                    $result = $modelClient -> create($client);
                    
                    if($result) {
                        echo json_encode("El Cliente Se Registro");
                    } else {
                        echo json_encode("El Cliente No Se Registro");
                    }
                }
            } else {
                echo json_encode($this -> error);
            }     
        }
    }

    $object = new NewClient();
    $object -> addClient();
?>