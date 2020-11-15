<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class SearchUser {
        public $rut;

        public function __construct(){
            $this -> rut = $_POST["rut"];
        }

        public function search() {
            $modelUser = new ModelUser();
            $result = $modelUser -> search(
                $this -> rut
            );
            
            if(count($result) > 0) {
                echo json_encode($result);
            }
        }
    }

    $object = new SearchUser();
    $object -> search();
?>