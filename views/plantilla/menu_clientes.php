<div class="btn-group">
    <?php
        if($resultado_rol["crear_clientes"]==1){
            ?>
                <a href="crear_cliente.php" type="button" class="btn btn-secondary" >Crear paciente</a>
            <?php
        }
    ?>
    
    <a href="lista_de_clientes.php" type="button" class="btn btn-secondary">Lista de pacientes</a>
</div>