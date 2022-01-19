<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');
 include('../backend/inventario/listas_articulos.php');

 $consulta_ventas = "SELECT * FROM venta_cabecera";
 $query_ventas = $conexion->query($consulta_ventas);
 
?>

<div class="p-5">
     <h3>Reporte de ventas</h3> <br>
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
              <th scope="col" width="25%">Forma de pago</th>
              <th scope="col">Condicion de pago</th>
              <th scope="col">Comprobante</th>
              <th scope="col">Itbis</th>
              <th scope="col">Descuentos</th>
              <th scope="col">Bruto</th>
              <th scope="col">Neto</th>
            </tr>
          </thead>
          <tbody>
              <?php
                while($venta = $query_ventas->fetch_assoc()){
                ?>
                    <tr>
                        <th scope="row"><?php echo $venta["cliente"] ?></th>
                        <td><?php echo $venta["forma_pago"] ?></td>
                        <td><?php echo $venta["condicion_pago"] ?></td>
                        <td><?php echo $venta["comprobante"] ?></td>
                        <td><?php echo "RD$ ".$venta["itbis"] ?></td>
                        <td><?php echo "RD$ ".$venta["descuentos"] ?></td>
                        <td><?php echo "RD$ ".$venta["bruto"] ?></td>
                        <td><?php echo "RD$ ".$venta["neto"] ?></td>
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
<div id="caja_busqueda">

</div>
        </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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