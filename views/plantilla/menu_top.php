<?php
session_start();
if(isset($_SESSION['usuario_logueado'])!=null){
 $acceso = 'logrado';
 include('../backend/control/cone.php');
 include("plantilla/permisos/permisos.php");
}
else{
  header('location:../index.php');
}

  ?>
  
   <script src="../bootstrap/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<link href="../bootstrap/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="../bootstrap/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../bootstrap/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="../bootstrap/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="../bootstrap/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../css/personalizado.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
   
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menú |</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="inventario.php" class="nav-link" href="#">Artículos</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="punto_de_facturacion.php">Facturación</a>
          </li>
        <li class="nav-item">
          <a href="crear_cliente.php" class="nav-link ">Clientes</a>
        </li>
        <li class="nav-item">
          <a href="registro_pacientes.php" class="nav-link ">Pacientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="lista_usuarios.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="crear_codigo.php">Impuestos</a>
        </li>
        
      </ul>
      
    </div>
    <div style="float:right">
    </div>
      <a href="../backend/control/cerrar.php"><button class="btn btn-dark">Cerrar sección</button></a>
  </div>
</nav>


