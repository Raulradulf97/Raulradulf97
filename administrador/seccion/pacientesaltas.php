<?php include("../template/cabecera.php"); ?>

<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre'] : "";
$txtFoto = (isset($_FILES['txtFoto']['name'])) ? $_FILES['txtFoto']['name'] : "";
$txtEdad = (isset($_POST['txtEdad']) ? $_POST['txtEdad'] : "");
$txtSexo = (isset($_POST['txtSexo']) ? $_POST['txtSexo'] : "");
$txtFecha = (isset($_POST['txtFecha']) ? $_POST['txtFecha'] : "");
$txtOcup = (isset($_POST['txtOcup']) ? $_POST['txtOcup'] : "");
$txtTel = (isset($_POST['txtTel']) ? $_POST['txtTel'] : "");
$txtdireccion = (isset($_POST['txtdireccion']) ? $_POST['txtdireccion'] : "");
$txtDelegacion = (isset($_POST['txtDelegacion']) ? $_POST['txtDelegacion'] : "");
$txtCiudad = (isset($_POST['txtCiudad']) ? $_POST['txtCiudad'] : "");
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

include("../config/bd.php");

switch ($accion) {
    case "Agregar":
        $senteciaSQL = $conexion->prepare("INSERT INTO pacientes (id, nombre, foto, edad, sexo, fecha_n, ocupacion, tel, domicilio,delegacion,ciudad) VALUES (null,:nombre,:foto,:edad,:sexo,:fecha_n,:ocupacion,:tel,:domicilio,:delegacion,:ciudad);");
        $senteciaSQL->bindParam(':nombre', $txtNombre);

        $fecha = new DateTime(); //intruccion de subida
        $nombreArchivo = ($txtFoto != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtFoto"]["name"] : "foto.jpg";
        $tmpFoto = $_FILES["txtFoto"]["tmp_name"];

        if ($tmpFoto != "") {
            move_uploaded_file($tmpFoto, "../../img/" . $nombreArchivo); //se mueve a la carpeta img donde se almacenaran
        }
        $senteciaSQL->bindParam(':foto', $nombreArchivo);
        $senteciaSQL->bindParam(':edad', $txtEdad);
        $senteciaSQL->bindParam(':sexo', $txtSexo);
        $senteciaSQL->bindParam(':fecha_n', $txtFecha);
        $senteciaSQL->bindParam(':ocupacion', $txtOcup);
        $senteciaSQL->bindParam(':tel', $txtTel);
        $senteciaSQL->bindParam(':domicilio', $txtdireccion);
        $senteciaSQL->bindParam(':delegacion', $txtDelegacion);
        $senteciaSQL->bindParam(':ciudad', $txtCiudad);
        $senteciaSQL->execute();
        header("Location:pacientesaltas.php");

        break;
    case "Modificar":

        $senteciaSQL = $conexion->prepare("UPDATE pacientes SET nombre=:nombre, edad=:edad, sexo=:sexo, fecha_n=:fecha_n, ocupacion=:ocupacion, tel=:tel, domicilio=:domicilio, delegacion=:delegacion, ciudad=:ciudad WHERE id=:id");
        $senteciaSQL->bindParam(':nombre', $txtNombre);
        $senteciaSQL->bindParam(':id', $txtID);
        $senteciaSQL->bindParam(':edad', $txtEdad);
        $senteciaSQL->bindParam(':sexo', $txtSexo);
        $senteciaSQL->bindParam(':fecha_n', $txtFecha);
        $senteciaSQL->bindParam(':ocupacion', $txtOcup);
        $senteciaSQL->bindParam(':tel', $txtTel);
        $senteciaSQL->bindParam(':domicilio', $txtdireccion);
        $senteciaSQL->bindParam(':delegacion', $txtDelegacion);
        $senteciaSQL->bindParam(':ciudad', $txtCiudad);
        $senteciaSQL->execute();

        if ($txtFoto != "") { //valida si contiene algo

            $fecha = new DateTime(); //intruccion de subida
            $nombreArchivo = ($txtFoto != "") ? $fecha->getTimestamp() . "_" . $_FILES["txtFoto"]["name"] : "foto.jpg";
            $tmpFoto = $_FILES["txtFoto"]["tmp_name"];

            move_uploaded_file($tmpFoto, "../../img/" . $nombreArchivo); //compiado del archivo a la carpeta img

            $senteciaSQL = $conexion->prepare("SELECT foto FROM pacientes WHERE id=:id");
            $senteciaSQL->bindParam(':id', $txtID);
            $senteciaSQL->execute();
            $pacien = $senteciaSQL->fetch(PDO::FETCH_LAZY); // se busca la imagen para borrar la imagen antigua


            if (
                isset($pacien["foto"]) && ($pacien["foto"] != "foto.jpg")
            ) {
                if (file_exists("../../img/" . $pacien["foto"])) {
                    unlink("../../img/" . $pacien["foto"]);
                }
            }


            $senteciaSQL = $conexion->prepare("UPDATE pacientes SET foto=:foto WHERE id=:id");
            $senteciaSQL->bindParam(':foto', $nombreArchivo);
            $senteciaSQL->bindParam(':id', $txtID);
            $senteciaSQL->execute();
        }
        header("Location:pacientesaltas.php");
        break;
    case "Cancelar":
        header("Location:pacientesaltas.php");
        break;
    case "Seleccionar":
        $senteciaSQL = $conexion->prepare("SELECT*FROM pacientes WHERE id=:id");
        $senteciaSQL->bindParam(':id', $txtID);
        $senteciaSQL->execute();
        $pacien = $senteciaSQL->fetch(PDO::FETCH_LAZY);

        $txtNombre = $pacien['nombre'];
        $txtFoto = $pacien['foto'];
        $txtEdad = $pacien['edad'];
        $txtFecha = $pacien['fecha_n'];
        $txtOcup = $pacien['ocupacion'];
        $txtTel = $pacien['tel'];
        $txtdireccion = $pacien['domicilio'];
        $txtDelegacion = $pacien['delegacion'];
        $txtCiudad = $pacien['ciudad'];

        break;

    case "Borrar":
        $senteciaSQL = $conexion->prepare("SELECT foto FROM pacientes WHERE id=:id");
        $senteciaSQL->bindParam(':id', $txtID);
        $senteciaSQL->execute();
        $pacien = $senteciaSQL->fetch(PDO::FETCH_LAZY);


        if (
            isset($pacien["foto"]) && ($pacien["foto"] != "foto.jpg")
        ) {
            if (file_exists("../../img/" . $pacien["foto"])) {
                unlink("../../img/" . $pacien["foto"]);
            }
        }

        $senteciaSQL = $conexion->prepare("DELETE FROM pacientes WHERE id=:id");
        $senteciaSQL->bindParam(':id', $txtID);
        $senteciaSQL->execute();
        header("Location:pacientesaltas.php");
        break;
}

$senteciaSQL = $conexion->prepare("SELECT*FROM pacientes");
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
            Ficha de indentificación
        </div>

        <div class="card-body">
            <form form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?> " name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class="form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtNombre; ?> " name="txtNombre" id="txtNombre" placeholder="Nombre del Paciente">
                </div>

                <div class="form-group">
                    <label for="txtFoto">Foto:</label>
                    <br />
                    <?php if ($txtFoto != "") { ?>
                        <img class="img-thumbnail" src="../../img/<?php echo $txtFoto ?>" width="50" alt="">
                    <?php } ?>
                    <input type="file" class="form-control" name="txtFoto" id="txtFoto">
                </div>

                <div class="form-group">
                    <label for="txtEdad">Edad:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtEdad; ?> " name="txtEdad" id="txtEdad" placeholder="Edad">
                </div>

                <div class="form-check">
                    <label for="txtSexo">Genero:</label><br />
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="F" checked="">
                        Femenino
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="txtSexo" id="txtSexo" value="M">
                        Masculino
                    </label>
                </div>

                <label for="fecha">Fecha de Ingreso:</label>
                <input type="date" id="start" name="txtFecha" value="<?php echo $txtFecha; ?>">

                <div class="form-group">
                    <label for="txtNombre">Ocupacion:</label>
                    <input type="text" required class="form-control" value="<?php echo $txtOcup; ?> " name="txtOcup" id="txtOcup" placeholder="Ocupacion">
                </div>

                <div class="form-group">
                    <label for="txtTel">Telefono:</label>
                    <input type="tel" required class="form-control" value="<?php echo $txtTel; ?> " name="txtTel" id="txtTel" placeholder="123-456-7890">
                </div>

                <div class="form-group">
                    <label for="txtdireccion">Direccion:</label>
                    <input type="street-address" required class="form-control" value="<?php echo $txtdireccion; ?> " name="txtdireccion" id="txtdireccion" placeholder="Domicilio">
                </div>

                <div class="form-group">
                    <label for="txtDelegacion">Delegacion:</label>
                    <input type="street-address" required class="form-control" value="<?php echo $txtDelegacion; ?> " name="txtDelegacion" id="txtDeleacion" placeholder="Delegacion">
                </div>

                <div class="form-group">
                    <label for="txtCiudad">Ciudad:</label>
                    <input type="city" required class="form-control" value="<?php echo $txtCiudad; ?> " name="txtCiudad" id="txtCiudad" placeholder="Ciudad">
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
    <table id="ficha_identi" class="table table-hover">
        <thead>
            <tr class="table-success">
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Fecha Ingreso</th>
                <th>Ocupacion</th>
                <th>Telefono</th>
                <th>Domicilio</th>
                <th>Delegacion</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listapaidenti as $pacien) { ?>
                <tr class="table-secondary">
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
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $pacien['id'] ?>" />
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary" />
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger" />
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="pacientesaltas.php?pagina=<?php echo $_GET['pagina']-1?>">
                    Anterior</a>
            </li>
            <?php for ($i = 0; $i < $paginas; $i++):?>

                <li class="page-item <?php echo $_GET['pagina']==$i+1 ?>"><a class="page-link" 
                href="pacientesaltas.php?pagina=<?php echo $i+1 ? 'active' : '' ?>">
                <?php echo $i+1 ?>
            </a></li>
            <?php endfor ?>
            <li class="page-item">
                <a class="page-link" href="pacientesaltas.php?pagina=<?php echo $_GET['pagina']+1?>"> Siguiente </a>
            </li>
        </ul>
    </nav> -->
</div>

<script >
      var tabla = document.querySelector("#ficha_identi");
      var dataTable = new DataTable(tabla,{
          perPage:4,
          perPageSelect:[4,8,12,] 
      });
</script>

<?php include("../template/pie.php"); ?>