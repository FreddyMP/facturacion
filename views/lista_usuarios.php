<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_usuarios.php');
 include('../backend/inventario/listas_articulos.php');
 $consulta_usuarios = "SELECT * FROM usuarios where estado = 1 and borrado_por is null";
 $query_usuarios = $conexion->query($consulta_usuarios);
?>
<div class="p-5 contenido">
<h3>Usuarios</h3>
        <div class="col-md-12">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Nombre</th>
      <th scope="col">Usuario</th>
      <th scope="col">Rol</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($usuarios = $query_usuarios->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $usuarios["id"] ?></th>
                <td><?php echo $usuarios["nombre"] ?></td>
                <td><?php echo $usuarios["user"] ?></td>
                <td><?php echo $usuarios["rol"] ?></td>
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
