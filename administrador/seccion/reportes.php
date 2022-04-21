<?php

use Dompdf\Dompdf;

ob_start(); //almacena en memoria a partir de la linea de codigo ->
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Reporte</title>
</head>
<body>
<?php
include("../config/bd.php");


$senteciaSQL = $conexion->prepare("SELECT*FROM pacientes");
$senteciaSQL->execute();
$listapaidenti = $senteciaSQL->fetchAll(PDO::FETCH_ASSOC); 


?>
<h1>Reporte Ficha de Identificacion.</h1>
<table class="table table-bordered">
        <thead>
            <tr class="table-secondary">
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Fecha Nacimiento</th>
                <th>Ocupacion</th>
                <th>Telefono</th>
                <th>Domicilio</th>
                <th>Delegacion</th>
                <th>Ciudad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listapaidenti as $pacien) { ?>
                <tr class="table-light">
                    <td><?php echo $pacien['id']; ?> </td>
                    <td><?php echo $pacien['nombre']; ?></td>
                    <td>
                        <img class="rounded" src="../../img/<?php echo $pacien['foto']; ?>" width="50" alt="">
                    </td>
                    <td><?php echo $pacien['edad']; ?></td>
                    <td><?php echo $pacien['sexo']; ?></td>
                    <td><?php echo $pacien['fecha_n']; ?></td>
                    <td><?php echo $pacien['ocupacion']; ?></td>
                    <td><?php echo $pacien['tel']; ?></td>
                    <td><?php echo $pacien['domicilio']; ?></td>
                    <td><?php echo $pacien['delegacion']; ?></td>
                    <td><?php echo $pacien['ciudad']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
<?php
include("../config/bd.php");


$senteciaSQL = $conexion->prepare("SELECT*FROM pacientes");
$senteciaSQL->execute();
$listapaidenti = $senteciaSQL->fetchAll(PDO::FETCH_ASSOC); 


?>
<?php $html= ob_get_clean(); //lo obtiene y lo guarda en la variables $html
//echo $html;

require_once'../libreria/dompdf/autoload.inc.php'; //libreria que funciona para convertir la tabla en pdf.
use Dompdf\Adapter\PDFLib;
$dompdf = new Dompdf();

$options=$dompdf->getOptions();
$options->set(array('isRemoteEnabled'=> true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
//$dompdf->setPaper('letter');
$dompdf->setPaper('A4','landscape');

$dompdf->render();
$dompdf->stream("archivo_.pdf", array("Attachment" => false));
?>

