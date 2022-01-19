<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 include('../backend/inventario/listas_articulos.php');
?>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="../js/jquery-mask/src/jquery.mask.js"></script>
<script src="../js/mascaras.js"></script>
<div class="p-5">
  <h3>Artículos</h3> 
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="busqueda" placeholder="Buscar articulo"><br>
            <div id="table_init">
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
                    while($articulo = $query_all->fetch_assoc()){
                    ?>
                        <tr>
                            <th scope="row"><?php echo $articulo["id"] ?></th>
                            <td><?php echo $articulo["nombre"] ?></td>
                            <td><?php echo $articulo["stock"] ?></td>
                            <td><?php echo $articulo["existencia"] ?></td>
                            <td><?php echo $articulo["cantidad_disponible"] ?></td>
                            <td><?php echo $articulo["fcv"] ?></td>
                            <td>
                                <small>
                                    <a href="ver_articulos.php?id=<?php echo $articulo["id"] ?>" class="btn btn-info">Ver</a>
                                    <a class= "btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $articulo["id"] ?>">del</a>
                                </small>
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
              <div id=tabla_busqueda>

              </div>
        </div>
</div>
<script>
$("#busqueda").keyup(function()
        {
          if( $("#busqueda").val() != ''){
            $("#table_init").hide();
            $("#tabla_busqueda").show();
            var articulo = $("#busqueda").val();
            $.ajax
            ({
                type:"post",
                url:"busquedas/buscar_articulo.php",
                dataType:'html',
                data:{'nombre':articulo},
                success: function(data)
                {
                    $("#tabla_busqueda").empty();
                    $("#tabla_busqueda").append(data);
                }
            }); 
          }else{
            $("#table_init").show();
            $("#tabla_busqueda").hide();
          }
            
        });
</script>