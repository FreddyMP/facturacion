
<div class="btn-group">

<?php 
    if($resultado_rol["crear_codigo_impuestos"]==1)
    {
    ?>
        <a href="crear_codigo.php" type="button" class="btn btn-primary" >Crear códigos de impuestos</a>
    <?php
    }
    //La variable $permiso_futuro es una variable que se solo tiene la funcion de mantener la estructura de los permisos sin afectar realmente,
    // esta variable será sustituida por el permiso correspondiente cuando sea creado
    $permiso_futuro = 1;
    if($permiso_futuro==1)
    {
    ?>
        <a href="lista_codigos.php" type="button" class="btn btn-primary">Lista de códigos impuestos</a>
    <?php
    }
    if($permiso_futuro==1)
    {
    ?>
        <a href="crear_comprobante.php" type="button" class="btn btn-primary"> Crear comprobantes</a>
    <?php
    }
    if($permiso_futuro==1)
    {
    ?>
        <a href="gestion_comprobantes.php" type="button" class="btn btn-primary">Gestión de comprobantes</a>
    <?php
    }
    ?>
    
    
</div>