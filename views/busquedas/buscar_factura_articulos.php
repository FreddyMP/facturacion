<?php
include("../../backend/control/cone.php");
$articulos_dev = [];

if(isset($_POST["factura"])){
    $Factura = $_POST["factura"];
}
else{
    $Factura = $_POST["factura"];
}

$consulta_busqueda = "SELECT venta_detalle.id_articulo as id_articulo,venta_detalle.id as id,venta_detalle.cantidad as cantidad, venta_detalle.articulo as nombre_articulo  from venta_cabecera inner join venta_detalle on venta_detalle.codigo = venta_cabecera.codigo_detalles where venta_cabecera.numero_factura = '$Factura'
 and  venta_cabecera.borrado_por is null and venta_cabecera.fecha_borrado is null and venta_detalle.borrado_por is null and venta_detalle.fecha_borrado is null order by venta_detalle.id desc";

$query_ventas = $conexion->query($consulta_busqueda);
$contador_articulos = 1;
?>       <form action="../backend/ventas/devolver_factura_arti.php" method="post">
                <input  type="hidden" name="factura" value="<?php echo $Factura ?>">
                <?php
                    while($venta = $query_ventas->fetch_assoc()){
                    
                ?> 
                <hr>
                    <div class="row alert-dark p-3">
                    
                        <div class="col-md-2">
                            <small><?php echo $venta["id_articulo"] ?></small>
                        </div>
                        <div class="col-md-6">
                            <small><?php echo $venta["nombre_articulo"] ?></small>
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" class="form-control" name="id<?php echo $contador_articulos?>" value="<?php echo $venta["id"] ?>">
                            <input type="number" class="form-control" min="0" max="<?php echo $venta["cantidad"] ?>" name="cantidad<?php echo $contador_articulos?>" value="1">
                        </div>
                        <div class="col-md-1">
                            <input  class="check_grande" type="checkbox" style="width:35px; height:35;" name="articulo<?php echo $contador_articulos?>" >
                            
                        </div>
                    </div>
               
                <?php
                $contador_articulos ++;
                }
              ?>
                <input type="submit" class="btn btn-primary mt-3" value="Registrar devolucion">
              </form>
          </tbody>
        </table>
       
        <script>
        
            
        </script>