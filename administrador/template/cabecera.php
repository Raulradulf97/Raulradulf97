<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location:../index.php");
} else {
  if ($_SESSION['usuario'] == "ok") {
    $nombreUsuario = $_SESSION["nombreUsuario"];
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <title>Administrador de Pacientes</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.0.2 -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


  <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
  <link href="css/reloj.css" rel="stylesheet" type="text/css">
  <script src="administrador/js/reloj.js" type="text/javascript"></script>


</head>

<body style="background: #E0EAFC;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #CFDEF3, #E0EAFC);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #CFDEF3, #E0EAFC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">
  <?php $url = "http://" . $_SERVER['HTTP_HOST'] . "/fisioterapia" ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="nav navbar-nav">
      <a class="nav-item nav-link" href="#">Administrador de pacientes</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/inicio.php">Inicio</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>">Ver sistio</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/cerrar.php">Cerrar sesión</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/pacientesaltas.php">Pacientes</a>
      <a class="nav-item nav-link" href="<?php echo $url; ?>/administrador/seccion/antecedentes.php">Antecedentes</a>
</div>
    </div>
  </nav>


  <div class="container">
  <div id="box">
  <div id="box-date"></div>
  <div id="box-time"></div>
</div>
    <br />
    <div class="row">