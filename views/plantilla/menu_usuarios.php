
<div class="btn-group">
    <?php 
        if($resultado_rol["crear_usuarios"]==1)
    {
    ?>
        <a href="crear_usuarios.php" type="button" class="btn btn-secondary" >Crear usuarios</a>
    <?php
    }
    ?>
    
    <a href="lista_usuarios.php" type="button" class="btn btn-secondary">Lista de usuarios</a>
    
    <?php 
        if($resultado_rol["crear_roles"]==1)
    {
    ?>
        <a href="crear_rol.php" type="button" class="btn btn-secondary">Crear roles</a>
    <?php
    }
    ?>
    
    <a href="lista_roles.php" type="button" class="btn btn-secondary">Lista de roles</a>
           
    
    
</div>