<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');
 include('../backend/inventario/listas_articulos.php');

 $consulta_ventas = "SELECT * FROM venta_cabecera order by id desc";
 $query_ventas = $conexion->query($consulta_ventas);
 
?>

<div class="p-5 contenido">
     <h3>Listado de ventas</h3> <br>
        <div class="row">
            <div class="col-md-2" id="Factura">
                <input type="text" class="form-control" name="" id="factura" placeholder="Factura"><br>
            </div>
            <div class="col-md-2" id="Desde">
                <input type="date" class="form-control"  id="desde" placeholder="Buscar articulo"><br>
            </div>
            <div class="col-md-2" id="Hasta">
                <input type="date" class="form-control" name="hasta" id="hasta" placeholder="Buscar articulo"><br>
            </div>
            <div class="col-md-1" id="Comprobante">
                <input type="text" class="form-control" name="" id="comprobante" placeholder="Comprobante"><br>
            </div>
            <div class="col-md-1" id="Formadepago">
                <input type="text" class="form-control" name="" id="forma" placeholder="Forma de pago"><br>
            </div>
            <div class="col-md-2" id="Condicion">
                <input type="text" class="form-control" name="" id="condicion" placeholder="Condicion de pago"><br>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" id="busqueda">Buscar</button>
                <button class="btn btn-primary">Descargar</button>
            </div>
        <table class="table" id="caja_init">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Fáctura</th>
              <th scope="col">Fecha</th>
              <th scope="col">Forma de pago</th>
              <th scope="col">Condicion de pago</th>
              <th scope="col">Comprobante</th>
              <th scope="col">Itbis</th>
              <th scope="col">Descuentos</th>
              <th scope="col">Bruto</th>
              <th scope="col">Neto</th>
              <th scope="col">Ver</th>
            </tr>
          </thead>
          <tbody>
              <?php
                while($venta = $query_ventas->fetch_assoc()){
                ?>
                    <tr>
                        <th scope="row"><?php echo $venta["cliente"] ?></th>
                        <th ><?php echo $venta["numero_factura"] ?></th>
                        <td ><?php echo $venta["fecha_creacion"] ?></td>
                        <td><?php echo $venta["forma_pago"] ?></td>
                        <td><?php echo $venta["condicion_pago"] ?></td>
                        <td><?php echo $venta["comprobante"] ?></td>
                        <td><?php echo "RD$ ".$venta["itbis"] ?></td>
                        <td><?php echo "RD$ ".$venta["descuentos"] ?></td>
                        <td><?php echo "RD$ ".$venta["bruto"] ?></td>
                        <td><?php echo "RD$ ".$venta["neto"] ?></td>
                        <td> <button class=" btn btn-info text-light" data-toggle="modal" data-target="#exampleModal<?php echo $venta["id"] ?>">Detalle</button> </td>
                    </tr>
                    <div class="modal fade" id="exampleModal<?php echo $venta["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog"  role="document">
                        <div class="modal-content" style=" width: 200% !important; margin-left:-35%"  >
                          <div class="modal-header">
                              <div class="row" style=" width: 100% !important">
                                <div class="col-md-2">
                                  <?php echo "<strong>Fáctura:</strong> <br>".$venta["numero_factura"] ?>
                                </div>
                                <div class="col-md-3">
                                  <?php echo "<strong>Fecha:</strong> <br>".$venta["fecha_creacion"] ?>
                                </div>
                                <div class="col-md-2">
                                   <?php echo "<strong>Comprobante:</strong> <br>".$venta["comprobante"] ?>
                                </div>
                                <div class="col-md-2">
                                  <?php echo "<strong>Condición:</strong> <br>".$venta["condicion_pago"] ?>
                                </div>
                                <div class="col-md-2">
                                  <?php echo "<strong>Forma de pago:</strong> <br>".$venta["forma_pago"] ?>
                                </div>
                              </div>  
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <strong>
                          <div class="row">
                                  <div class="col-md-1 p-2">
                                      código
                                  </div>
                                  <div class="col-md-4 p-2">
                                       Artículo
                                  </div>
                                  <div class="col-md-2 p-2">
                                      Precio sin ITBIS
                                  </div>
                                  <div class="col-md-2 p-2">
                                    Precio con ITBIS
                                  </div>
                                  <div class="col-md-1 p-2">
                                    Cantidad
                                  </div>
                                  <div class="col-md-2 p-2">
                                    Total
                                  </div>
                              </div>
                              </strong>
                          <?php
                            $codigo = $venta["codigo_detalles"] ;
                            $consulta_detalle = "SELECT * FROM venta_detalle where codigo = '$codigo'";
                            $query_detalle = $conexion->query($consulta_detalle);
                             while($linea = $query_detalle->fetch_assoc())
                             {
                               ?>
                              <div class="row p-2 mt-2" >
                                  <div class="col-md-1 bg-info p-3">
                                      <?php
                                          echo $linea["id_articulo"] ;
                                      ?>
                                  </div>
                                  <div class="col-md-4 bg-info p-3">
                                      <?php
                                          echo $linea["articulo"] ;
                                      ?>
                                  </div>
                                  <div class="col-md-2 bg-info p-3">
                                      <?php
                                          echo "RD$".$linea["precio_sin_itbis"] ;
                                      ?>
                                  </div>
                                  <div class="col-md-2 bg-info p-3">
                                      <?php
                                          echo "RD$".$linea["precio_con_itbis"] ;
                                      ?>
                                  </div>
                                  <div class="col-md-1 bg-info p-3">
                                      <?php
                                          echo $linea["cantidad"] ;
                                      ?>
                                  </div>
                                  <div class="col-md-2 bg-info p-3">
                                      <?php
                                          echo "RD$".$linea["total_con_itbis"] ;
                                      ?>
                                  </div>
                              </div>
                              
                               
                            <?php
                              }
                          ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php
                }
              ?>
          </tbody>
        </table>
<div id="caja_busqueda">

</div>
        </div>
</div>
<script src="../bootstrap/jquery.min.js"></script>
<script>
$("#busqueda").click(function()
        {
            $("#caja_init").hide();
            $("#caja_busqueda").show();
            var Factura = $("#factura").val();
            var Desde = $("#desde").val();
            var Hasta = $("#hasta").val();
            var Comprobante = $("#comprobante").val();
            var Forma = $("#forma").val();
            var Condicion = $("#condicion").val();
            $.ajax
            ({
                type:"post",
                url:"busquedas/buscar_venta.php",
                dataType:'html',
                data:{'factura':Factura,'desde':Desde, 'hasta':Hasta, 'comprobante':Comprobante, 'forma':Forma, 'condicion':Condicion },
                success: function(data)
                {
                    $("#caja_busqueda").empty();
                    $("#caja_busqueda").append(data);
                }
            });  
        });
</script>