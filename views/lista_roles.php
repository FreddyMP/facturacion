<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_usuarios.php');
 include('../backend/inventario/listas_articulos.php');
 $consulta_roles = "SELECT id, rol FROM roles_y_permisos where borrado_por is null";
 $query_roles = $conexion->query($consulta_roles);
?>

<div class="p-5">
  <h3>Almacenes</h3>
        <div class="col-md-12">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Nombre</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($roles = $query_roles->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $roles["id"] ?></th>
                <td><?php echo $roles["rol"] ?></td>
                <td>
                    <small>
                        <button class="btn btn-info">Ver</button>
                        <button class= "btn btn-danger">del</button>
                    </small>
                </td>
            </tr>
        <?php
        }
      ?>
  </tbody>
</table>
        </div>
</div>
