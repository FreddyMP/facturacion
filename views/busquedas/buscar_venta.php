<?php
include("../../backend/control/cone.php");


if(isset($_POST["factura"])){
  $Factura = "like '%".$_POST["factura"]."%'";
}
else{
  $Factura = "is not null";
}

if(isset($_POST["forma"])){
  $forma = "like '%".$_POST["forma"]."%'";
}
else{
  $forma = "is not null";
}
if(isset($_POST["condicion"])){
  $condicion = "like '%".$_POST["condicion"]."%'";
}
else{
  $condicion = "is not null";
}

if(isset($_POST["comprobante"])){
  $comprobante = "like '%".$_POST["comprobante"]."%'";
}
else{
  $comprobante = "is not null";
}

$desde = $_POST["desde"];
$hasta = $_POST["hasta"];


$consulta_busqueda = "SELECT * from venta_cabecera 
 where numero_factura ".$Factura."
 and fecha_creacion >= '$desde' 
 and (fecha_creacion <= '$hasta' or fecha_creacion like '%$hasta%')
 and comprobante ".$comprobante."
 and condicion_pago ".$condicion."
 and forma_pago ".$forma."
 and  borrado_por is null and fecha_borrado is null order by id desc";

$query_ventas = $conexion->query($consulta_busqueda);

?>     
<table class="table">
          <thead>
            <tr>
              <th scope="col">Cliente</th>
              <th scope="col">Fáctura</th>
              <th scope="col">Fecha</th>
              <th scope="col" >Forma de pago</th>
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