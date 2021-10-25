<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_usuarios.php');
 include('../backend/inventario/listas_articulos.php');
 $consulta_roles = "SELECT id, rol FROM roles_y_permisos where borrado_por is null";
 $query_roles = $conexion->query($consulta_roles);
?>
<form action="../backend/usuarios/crear_usuarios.php" method="post">

<div class="container p-3">
        <div class="col-md-12">
            <H3>Crear usuario</H3><br>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1" placeholder="Inserte el nombre del usuario">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Usuario</label>
                    <input type="text" class="form-control" name="user" id="exampleFormControlInput1" placeholder="Inserte el usuario de acceso">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="contrasena" id="exampleFormControlInput1" placeholder="********">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Rol</label>
                    <select name="rol" class="form-control" id="">
                    <?php
                        while($roles = $query_roles->fetch_assoc())
                        {
                    ?>
                        <option value="<?php echo $roles["id"] ?>"><?php echo $roles["rol"] ?></option>
                    <?php
                        }
                    ?>
                    </select>
                </div>
               
                <div class="col-md-6 mt-3">
                    <button class= "btn btn-primary">Guardar</button>
                </div>
                
            
            </div>
        </div>
</div>
</form>