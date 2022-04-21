<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <title>Fisioterapia</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="fisioterapia.php">Fisioterapia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
            <?php $url="http://".$_SERVER['HTTP_HOST']."/fisioterapia" ?>
                <a class="nav-link" href="<?php echo $url;?>/administrador">Pacientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Ejercicios</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <br />
        <div class="row">