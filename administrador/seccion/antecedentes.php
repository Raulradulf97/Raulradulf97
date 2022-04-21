<?php include("../template/cabecera.php"); ?>
<?php

$txtidantece = (isset($_POST['txtAntece'])) ? $_POST['txtAntece'] : "";
$txtalergias = (isset($_POST['txtAlergias'])) ? $_POST['txtAlergias'] : "";
$txtenfer_diag = (isset($_POST['txtEnfer'])) ? $_POST['txtEnfer'] : "";
$txtmedicamentos = (isset($_POST['txtMedicamentos'])) ? $_POST['txtMedicamentos'] : "";
$txttraumatismo = (isset($_POST['txtTraumatismo']) ? $_POST['txtTraumatismo'] : "");
$txthospita = (isset($_POST['txtHopitali']) ? $_POST['txtHospitali'] : "");
$txtcirugias = (isset($_POST['txtCirugias']) ? $_POST['txtCirugias'] : "");
$txttrans = (isset($_POST['txtTransfusion']) ? $_POST['txtTransfusion'] : "");
$txtalertas = (isset($_POST['txtAlertas']) ? $_POST['txtAlertas'] : "");
$txtalimentacion = (isset($_POST['txtAlimentacion']) ? $_POST['txtAlimentacion'] : "");
$txtact_fisica = (isset($_POST['txtAct_fisica']) ? $_POST['txtAct_fisica'] : "");
$txthoras_sueno = (isset($_POST['txtHoras_sueno']) ? $_POST['txtHoras_sueno'] : "");
$txtno_patologicos = (isset($_POST['txtNo_patologicos']) ? $_POST['txtNo_patologicos'] : "");
$txtotros = (isset($_POST['txtOtros']) ? $_POST['txtOtros'] : "");
$txtheredofamiliares = (isset($_POST['txtHeredofamiliares']) ? $_POST['txtHeredofamiliares'] : "");
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");


switch ($accion) {
    case "Agregar":
        $senteciaSQL = $conexion->prepare("INSERT INTO antecedentes (id_antecede, alergias,enfer_diag,medicamentos,traumatismos,hospi_recien,cirugias, transfusiones,alertas,alimentacion,act_fisica,horas_sueno,no_patologicos,otros,heredofamiliares) VALUES (NULL, :alergias, :enfer_diag , :medicamentos, :traumantismos, :hospi_recien, :cirugias, :transfusiones, :alertas, :alimentacion, :act_fisica, :horas_sueno, :no_patologicos, :otros, :heredofamiliares);");
        
        $senteciaSQL->bindParam(':alergias', $txtalergias);
        $senteciaSQL->bindParam(':enfer_diag', $txtenfer_diag);
        $senteciaSQL->bindParam(':medicamentos', $txtmedicamentos);
        $senteciaSQL->bindParam(':traumantismos', $txttraumatismo);
        $senteciaSQL->bindParam(':hospi_recien', $txthospita);
        $senteciaSQL->bindParam(':cirugias', $txtcirugias);
        $senteciaSQL->bindParam(':transfusiones', $txttrans);
        $senteciaSQL->bindParam(':alertas', $txtalertas);
        $senteciaSQL->bindParam(':alimentacion', $txtalimentacion);
        $senteciaSQL->bindParam(':act_fisica', $txtact_fisica);
        $senteciaSQL->bindParam(':horas_sueno', $txthoras_sueno);
        $senteciaSQL->bindParam(':no_patologicos', $txtno_patologicos);
        $senteciaSQL->bindParam(':otros', $txtotros);
        $senteciaSQL->bindParam(':heredofamiliares', $txtheredofamiliares);
        $senteciaSQL->execute();
        header("Location:antecedentes.php");

        break;
    case "Modificar":

        $senteciaSQL = $conexion->prepare("UPDATE antecedentes SET alergias=:alergias, enfer_diag=:enfer_diag, medicamentos=:medicamentos, traumatismos=:traumatismos, hospi_recien=:hospi_recien, cirugias=:cirugias, transfusiones=:transfusiones, alertas=:alertas, alimentacion=:alimentacion, act_fisica=:act_fisica, horas_sueno=:horas_sueno, no_patologicos=:no_patologicos, otros=:otros, heredofamiliares=:heredofamiliares  WHERE id_antecede=:id_antecede");
        $senteciaSQL->bindParam(':alergias', $txtalergias);
        $senteciaSQL->bindParam(':enfer_diag', $txtenfer_diag);
        $senteciaSQL->bindParam(':medicamentos', $txtmedicamentos);
        $senteciaSQL->bindParam(':traumatismos', $txttraumatismo);
        $senteciaSQL->bindParam(':hospi_recien', $txthospita);
        $senteciaSQL->bindParam(':cirugias', $txtcirugias);
        $senteciaSQL->bindParam(':transfusiones', $txttrans);
        $senteciaSQL->bindParam(':alertas', $txtalertas);
        $senteciaSQL->bindParam(':alimentacion', $txtalimentacion);
        $senteciaSQL->bindParam(':act_fisica', $txtact_fisica);
        $senteciaSQL->bindParam(':horas_sueno', $txthoras_sueno);
        $senteciaSQL->bindParam(':no_patologicos', $txtno_patologicos);
        $senteciaSQL->bindParam(':otros', $txtotros);
        $senteciaSQL->bindParam(':heredofamiliares', $txtheredofamiliares);
        $senteciaSQL->bindParam(':id_antecede',$txtidantece);
        $senteciaSQL->execute();
        header("Location:antecedentes.php");
        break;
    case "Cancelar":
        header("Location:antecedentes.php");
        break;
    case "Seleccionar":
        $senteciaSQL = $conexion->prepare("SELECT*FROM antecedentes WHERE id_antecede=:id_antecede");
        $senteciaSQL->bindParam(':id_antecede', $txtidantece);
        $senteciaSQL->execute();
        $pacien = $senteciaSQL->fetch(PDO::FETCH_LAZY);

        $txtalergias = $pacien['alergias'];
        $txtenfer_diag = $pacien['enfer_diag'];
        $txtmedicamentos = $pacien['medicamentos'];
        $txttraumatismo = $pacien['traumatismos'];
        $txthospita = $pacien['hospi_recien'];
        $txtcirugias = $pacien['cirugias'];
        $txttrans = $pacien['transfusiones'];
        $txtalertas = $pacien['alertas'];
        $txtalimentacion = $pacien['alimentacion'];
        $txtact_fisica = $pacien['act_fisica'];
        $txthoras_sueno = $pacien['horas_sueno'];
        $txtno_patologicos = $pacien['no_patologicos'];
        $txtotros = $pacien['otros'];
        $txtheredofamiliares = $pacien['heredofamiliares'];
        break;

    case "Borrar":
        

        $senteciaSQL = $conexion->prepare("DELETE FROM antecedentes WHERE id_antecede=:id_antecede");
        $senteciaSQL->bindParam('id_antecede', $txtidantece);
        $senteciaSQL->execute();
        header("Location:antecedentes.php");
        break;
}

$senteciaSQL = $conexion->prepare("SELECT*FROM antecedentes");
$senteciaSQL->execute();
$totaldatos = $senteciaSQL->rowCount();
//echo $totaldatos;
$datosxpagina = 5;
$paginas = $totaldatos / 5;
$paginas = ceil($paginas);
$listapaidenti = $senteciaSQL->fetchAll(PDO::FETCH_ASSOC); //CON EL METODO FETCH_ASSOC, RECUPERA TODOS LOS REGISTROS PARA GUARDARLOS EN LA VARIABLE $listapaindeti.

?>

<div class="col-md-3">

    <div class="card">

        <div class="card-header">
            Antecedentes Del Paciente
        </div>

        <div class="card-body">
            <form form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="txtAntece">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtidantece; ?> " name="txtAntece" id="txtAntece" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="txtAlergias">Alergias:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtalergias; ?> " name="txtAlergias" id="txtAlergias" placeholder="Alergias">
                </div>

                <div class="form-group">
                    <label for="txtEnfer">Enfermedades:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtenfer_diag; ?> " name="txtEnfer" id="txtEnfer" placeholder="Enfermedades Diagnosticadas">
                </div>

                <div class="form-group">
                    <label for="txtMedicamentos">Medicamentos:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtenfer_diag; ?> " name="txtMedicamentos" id="txtMedicamentos" placeholder="Medicamentos que consume">
                </div>


                <div class="form-group">
                    <label for="txtHospitali">Traumatismos:</label>
                    <input type="text" required class="form-control" value="<?php echo $txttraumatismo; ?> " name="txtTraumatismo" id="txtTraumatismo" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtHospitali">Hospitalizaciones Recientes:</label>
                    <input type="text" required class="form-control" value="<?php echo $txthospita; ?> " name="txtHospitali" id="txtHospitali" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtCirugias">Cirugias:</label>
                    <input type="text" required class="form-control" value="<?php echo $txthospita; ?> " name="txtCirugias" id="txtCirugias" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtTransfusion">Transfusiones:</label>
                    <input type="text" required class="form-control" value="<?php echo $txttrans; ?> " name="txtTransfusion" id="txtTransfusion" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtAlertas">Alertas:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtalertas; ?> " name="txtAlertas" id="txtAlertas" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtAlimentacion">Alimentacion:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtalimentacion; ?> " name="txtAlimentacion" id="txtAlimentacion" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtAct_fisica">Actividad Fisica:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtact_fisica; ?> " name="txtAct_fisica" id="txtAct_fisica" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtHoras_sueno">Horas de sueño:</label>
                    <input type="text" required class="form-control" value="<?php echo $txthoras_sueno; ?> " name="txtHoras_sueno" id="txtHoras_sueno" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtNo_patologicos">Visios:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtno_patologicos; ?> " name="txtNo_patologicos" id="txtNo_patologicos" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtOtros">Otros:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtotros; ?> " name="txtOtros" id="txtOtros" placeholder="">
                </div>

                <div class="form-group">
                    <label for="txtHeredofamiliares">Heredofamiliares:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtheredofamiliares; ?> " name="txtHeredofamiliares" id="txtHeredofamiliares" placeholder="">
                </div>



                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion == "Seleccionar") ? "disabled" : "" ?> value="Agregar" class="btn btn-success">Agregar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : "" ?> value="Modificar" class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion != "Seleccionar") ? "disabled" : "" ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                </div>
            </form>

        </div>

    </div>

</div>




<div class="col-md-7">
    <a href="reportes.php">Generar Reporte PDF</a>
    <table id="ficha_identi" class="table table-condensed">
        <thead>
            <tr class="table-success">
                <th>ID</th>
                <th>Alergias</th>
                <th>Enfermedades Diagnosticadas</th>
                <th>Medicamentos</th>
                <th>Traumatismos</th>
                <th>Hospitalizaciones</th>
                <th>Cirugias</th>
                <th>Transfusiones</th>
                <th>Alertas</th>
                <th>Alimentación</th>
                <th>Actividad Fisica</th>
                <th>Horas de sueño</th>
                <th>Visios</th>
                <th>Otros</th>
                <th>Heredofamiliares</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listapaidenti as $pacien) { ?>
                <tr class="table-secondary">
                    <td><?php echo $pacien['id_antecede']; ?> </td>
                    <td><?php echo $pacien['alergias']; ?></td>
                    
                    <td><?php echo $pacien['enfer_diag']; ?></td>
                    <td><?php echo $pacien['medicamentos']; ?></td>
                    <td><?php echo $pacien['traumatismos']; ?></td>
                    <td><?php echo $pacien['hospi_recien']; ?></td>
                    <td><?php echo $pacien['cirugias']; ?></td>
                    <td><?php echo $pacien['transfusiones']; ?></td>
                    <td><?php echo $pacien['alertas']; ?></td>
                    <td><?php echo $pacien['alimentacion']; ?></td>
                    <td><?php echo $pacien['act_fisica']; ?></td>
                    <td><?php echo $pacien['horas_sueno']; ?></td>
                    <td><?php echo $pacien['no_patologicos']; ?></td>
                    <td><?php echo $pacien['otros']; ?></td>
                    <td><?php echo $pacien['heredofamiliares']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtAntece" id="txtAntece" value="<?php echo $pacien['id_antecede'] ?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include("../template/pie.php"); ?>
