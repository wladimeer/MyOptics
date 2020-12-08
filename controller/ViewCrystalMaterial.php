<?php
    namespace controller;

    use model\ModelCrystalMaterial;
    require_once("../model/ModelCrystalMaterial.php");

    class ViewCrystalMaterial {

        public function view() {
            $modelCrystalMaterial = new ModelCrystalMaterial();
            $result = $modelCrystalMaterial -> read();

            if(count($result) > 0) {
                echo json_encode($result);
            }
        }

    }

    $object = new ViewCrystalMaterial();
    $object -> view();
?>