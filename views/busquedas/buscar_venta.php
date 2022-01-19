<?php
include("../../backend/control/cone.php");
$Factura = $_POST["factura"];
$desde = $_POST["desde"];
$hasta = $_POST["hasta"];
$forma = $_POST["forma"];
$condicion = $_POST["condicion"];
$comprobante = $_POST["comprobante"];
echo $desde;
$consulta_busqueda = "SELECT * from venta_cabecera 
where numero_factura like '%$Factura%' and fecha_creacion >= $desde  and borrado_por is null and fecha_borrado is null";
$query_ventas = $conexion->query($consulta_busqueda);

?>     
<table class="table">
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