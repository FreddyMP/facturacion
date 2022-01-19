<?php
include("../../backend/control/cone.php");
$nombre = $_POST["nombre"];
$consulta_busqueda = "SELECT id, nombre, stock, existencia, cantidad_disponible, fcv from articulos where nombre like '%$nombre%' or id like '%$nombre%' and borrado_por is null and fecha_borrado is null";
$query_busqueda = $conexion->query($consulta_busqueda);

?>
<table class="table">
                <thead>
                  <tr>
                    <th scope="col">Código</th>
                    <th scope="col" width="25%">Nombre</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Existencia</th>
                    <th scope="col">Disponible</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while($articulo2 = $query_busqueda->fetch_assoc()){
                    ?>
                        <tr>
                            <th scope="row"><?php echo $articulo2["id"] ?></th>
                            <td><?php echo $articulo2["nombre"] ?></td>
                            <td><?php echo $articulo2["stock"] ?></td>
                            <td><?php echo $articulo2["existencia"] ?></td>
                            <td><?php echo $articulo2["cantidad_disponible"] ?></td>
                            <td><?php echo $articulo2["fcv"] ?></td>
                            <td>
                                <small>
                                    <a href="ver_articulos.php?id=<?php echo $articulo2["id"] ?>" class="btn btn-info">Ver</a>
                                    <a class= "btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $articulo2["id"] ?>">del</a>
                                </small>
                            </td>
                        </tr>
                            <div class="modal fade" id="exampleModal<?php echo $articulo2["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $articulo2["nombre"] ?></h5>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Eliminar este articulo?
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <a href='../backend/inventario/eliminar_articulo.php?id=<?php echo $articulo2["id"] ?>' type="button" class="btn btn-Danger">Eliminar</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php
                        }
                      ?>
                  </tbody>
                </table>