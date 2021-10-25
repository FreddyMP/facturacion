<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 include('../backend/inventario/listas_articulos.php');
?>

<div class="p-5">
    <h3>Pasar inventario</h3>
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar articulo"><br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col" width="25%">Nombre</th>
      <th scope="col">Stock</th>
      <th scope="col">Existencia</th>
      <th scope="col">Disponible</th>
      <th scope="col">Unidad</th>
      <th scope="col">Contado físicamente</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($articulo = $query_all->fetch_assoc()){
        ?>
            <tr>
                <th class="p-2" scope="row"><?php echo $articulo["id"] ?></th>
                <td class="p-2" ><?php echo $articulo["nombre"] ?></td>
                <td><?php echo $articulo["stock"] ?></td>
                <td><?php echo $articulo["existencia"] ?></td>
                <td><?php echo $articulo["cantidad_disponible"] ?></td>
                <td><?php echo $articulo["fcv"] ?></td>
                <td class="p-2" >
                    _______________________
                </td>
            </tr>
            <div class="modal fade" id="exampleModal<?php echo $articulo["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $articulo["nombre"] ?></h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Eliminar este articulo?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href='../backend/inventario/eliminar_articulo.php?id=<?php echo $articulo["id"] ?>' type="button" class="btn btn-Danger">Eliminar</a>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
      ?>
  </tbody>
</table>
        </div>
</div>
