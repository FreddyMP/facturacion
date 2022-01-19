<div class="btn-group">
   <?php
    //La variable $permiso_futuro es una variable que se solo tiene la funcion de mantener la estructura de los permisos sin afectar realmente,
    // esta variable será sustituida por el permiso correspondiente cuando sea creado
    $permiso_futuro = 1;
    if($permiso_futuro==1)
    {
    ?>
        <a href="registro_pacientes.php" type="button" class="btn btn-primary" >Registrar pacientes</a>
    <?php
    }
    if($permiso_futuro==1)
    {
    ?>
        <a href="lista_pacientes.php" type="button" class="btn btn-primary">Lista de pacientes</a>
    <?php
    }
   ?>
    
    
   
</div>