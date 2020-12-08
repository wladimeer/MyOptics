<?php
    namespace controller;

    use model\ModelFrame;
    require_once("../model/ModelFrame.php");

    class ViewFrame {

        public function view() {
            $modelFrame = new ModelFrame();
            $result = $modelFrame -> read();

            if(count($result) > 0) {
                echo json_encode($result);
            }
        }

    }

    $object = new ViewFrame();
    $object -> view();
?>