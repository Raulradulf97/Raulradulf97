<?php 
session_start();
if($_POST){
//esta linea se cambiaria para una consilta de base de datos para el inicio de session
  if(($_POST['usuario']=="fisio1")&&($_POST['contrasenia']=="sistema")){ 

    $_SESSION['usuario']="ok";
    $_SESSION['nombreUsuario']="fisio1";
    header('Location:inicio.php');
  }else{
             $mensaje="Error: El usuario o contraseña con incorrectos";
  }

}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Adminstrador de Pacientes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  </head>
  <body>
      
  <div class="container">
      <div class="row">

      <div class="col-md-4">
          
      </div>

          <div class="col-md-4">
                <br/><br/><br/><br/><br/>
             <div class="card">
                 <div class="card-header">
                     Login
                 </div>
                 <div class="card-body">
                     <?php if(isset($mensaje)) {?>
                     <div class="alert alert-danger" role="alert">
                      <?php echo $mensaje;  ?>
                     </div>
                     <?php } ?>
                     
                   <form method="POST">
                   <div class = "form-group">
                   <label >Usuario</label>
                   <input type="text" class="form-control" name="usuario"  placeholder="Escribe tu Usuario">
                   </div>
                   <div class="form-group">
                   <label >Contraseña:</label>
                   <input type="password" class="form-control" name="contrasenia" placeholder="Contraseña">
                   </div>
                   
                   <button type="submit" class="btn btn-primary">Entrar al Sistema</button>
                   </form>
                   
                   

                 </div>
                 
             </div>
          </div>
          
      </div>
  </div>
  
  </body>
</html>