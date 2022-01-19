<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 include('../backend/inventario/listas_articulos.php');
 $consulta_categorias = "SELECT * FROM categorias where borrado_por is null";
 $query_categorias = $conexion->query($consulta_categorias);
?>
<div class="p-5">
<h3>Categorías</h3>
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
        while($categorias = $query_categorias->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $categorias["id"] ?></th>
                <td><?php echo $categorias["nombre"] ?></td>
                <td><?php echo $categorias["descripcion"] ?></td>
                <td>
                    <small>
                        <a href="ver_categoria.php?id=<?php echo $categorias['id'] ?>" class="btn btn-info">Ver</a>
                        <a href="../backend/inventario/del_categoria.php?id=<?php echo $categorias['id'] ?>" class= "btn btn-danger">del</a>
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
