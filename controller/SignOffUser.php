<?php
    namespace controller;

    class SignOffUser {

        public function signOff() {
            session_start();

            $role = $_SESSION["user"]["role"];
    
            unset($_SESSION["user"]);
            header("Location: ../index.php");
        }
        
    }

    $object = new SignOffUser();
    $object -> signOff();
?>