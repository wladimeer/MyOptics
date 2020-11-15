<?php
    namespace controller;

    use model\ModelUser;
    require_once("../model/ModelUser.php");

    class ViewUser {

        public function view() {
            $modelUser = new ModelUser();
            $result = $modelUser -> read();

            if(count($result) > 0) {
                echo json_encode($result);
            }
        }

    }

    $object = new ViewUser();
    $object -> view();
?>