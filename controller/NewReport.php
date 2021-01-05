<?php
    namespace controller;

    use model\ModelRecipe;
    require_once("../model/ModelRecipe.php");
    require_once("../library/tcpdf.php");

    class NewReport {
        
        public function view() {
            session_start();

            if(isset($_SESSION["user"])) {
                $modelRecipe = new ModelRecipe();

                $result = $modelRecipe -> readById(
                    $_GET["id"]
                );

                $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                $pdf -> SetCreator(PDF_CREATOR);
                $pdf -> SetAuthor("Sebastián Benavides");
                $pdf -> SetTitle("Reporte de Receta");

                $pdf -> SetHeaderData(
                    PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE,
                    PDF_HEADER_STRING. $result[0]["name_client"], array(64, 66, 71), array(0, 0, 0)
                );
                $pdf -> setFooterData(array(64, 66, 71), array(0, 0, 0));
                $pdf -> setHeaderFont(Array(PDF_FONT_NAME_MAIN, "", PDF_FONT_SIZE_MAIN));
                $pdf -> setFooterFont(Array(PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA));
                $pdf -> SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf -> SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $pdf -> SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf -> SetFooterMargin(PDF_MARGIN_FOOTER);
                $pdf -> SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $pdf -> setImageScale(PDF_IMAGE_SCALE_RATIO);
                $pdf -> setFontSubsetting(true);
                $pdf -> SetFont("courierB", "", 11, "", true);

                $pdf -> AddPage();
                $pdf -> setTextShadow(
                    array("enabled" => true, "depth_w" => 0.2, "depth_h" => 0.2,
                    "color" => array(196, 196, 196), "opacity" => 1, "blend_mode" => "Normal")
                );

                $html = ('
                    <div style="text-align:center">
                        <h1>Reporte de Receta ' .$result[0]['id']. '</h1><br>

                        <h4>Detalles del Cliente</h4>
                        <table border="1" style="text-align:center;">
                            <thead>
                                <tr style="background-color:#54585D; color:#FFFFFF;">
                                    <th>Rut</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>' .$result[0]["rut_client"]. '</td>
                                    <td>' .$result[0]["name_client"]. '</td>
                                    <td>' .$result[0]["phone_client"]. '</td>
                                </tr>
                            </tbody>
                        </table><br><br>

                        <h4>Detalles Acerca del Lente</h4>
                        <table border="1" style="text-align:center;">
                            <thead>
                                <tr style="background-color:#54585D; color:#FFFFFF;">
                                    <th>Marco</th>
                                    <th>Prisma</th>
                                    <th>Tipo de Lente</th>
                                    <th>Tipo de Cristal</th>
                                    <th>Material Cristal</th>
                                    <th>Valor Lente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>' .$result[0]["frame"]. '</td>
                                    <td>' .$result[0]["prism"]. '</td>
                                    <td>' .$result[0]["lens_type"]. '</td>
                                    <td>' .$result[0]["crystal_type"]. '</td>
                                    <td>' .$result[0]["crystal_material"]. '</td>
                                    <td>$' .$result[0]["lens_value"]. '</td>
                                </tr>
                            </tbody>
                        </table><br><br>

                        <h4>Fechas Asociadas al Lente</h4>
                        <table border="1" style="text-align:center;">
                            <thead>
                                <tr style="background-color:#54585D; color:#FFFFFF;">
                                    <th>Fecha de Entrega</th>
                                    <th>Fecha de Retiro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>' .$result[0]["deliver_date"]. '</td>
                                    <td>' .$result[0]["retirement_date"]. '</td>
                                </tr>
                            </tbody>
                        </table><br><br>

                        <h4>Observación: ' .$result[0]["observation"]. '</h4>
                    </div>
                ');

                $pdf -> writeHTMLCell(0, 0, "", "", $html, 0, 1, 0, true, "", true);
                $pdf -> Output("Reporte de " .$result[0]["name_client"]. ".pdf", "I");
            } else {
                echo json_encode("Acceso Denegado");
            }
        }

    }

    $object = new NewReport();
    $object -> view();
?>