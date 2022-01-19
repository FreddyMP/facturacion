<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 include('../backend/inventario/listas_articulos.php');
 $consulta_almacenes = "SELECT * FROM almacenes where borrado_por is null";
 $query_almacenes = $conexion->query($consulta_almacenes);
?>

<div class="p-5">
  <h3>Almacenes</h3>
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar almacén"><br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Nombre</th>
      <th scope="col">Descripción</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($almacen = $query_almacenes->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $almacen["id"] ?></th>
                <td><?php echo $almacen["nombre"] ?></td>
                <td><?php echo $almacen["descripcion"] ?></td>
                <td>
                    <small>
                        <a href='ver_almacen.php?id=<?php echo $almacen["id"] ?>'  class="btn btn-info">Ver</a>
                        <a href='../backend/inventario/del_almacen.php?id=<?php echo $almacen["id"] ?>' class= "btn btn-danger">del</a>
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
