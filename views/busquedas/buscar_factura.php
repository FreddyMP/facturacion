<?php
include("../../backend/control/cone.php");


if(isset($_POST["factura"])){
    $Factura = $_POST["factura"];
}
else{
    $Factura = $_POST["factura"];
}

$consulta_busqueda = "SELECT venta_cabecera.numero_factura as numero_factura, venta_cabecera.id as id, pacientes.nombre as nombre, pacientes.apellido as apellido  from venta_cabecera inner join pacientes on pacientes.id = venta_cabecera.cliente where numero_factura = '$Factura'
 and  venta_cabecera.borrado_por is null and venta_cabecera.fecha_borrado is null order by id desc";

$query_ventas = $conexion->query($consulta_busqueda);

?>     

              <?php
                while($venta = $query_ventas->fetch_assoc()){
                ?> 

                <div class="col-md-3">
                    <small><?php echo $venta["numero_factura"] ?></small>
                </div>
                <div class="col-md-4">
                    <small><?php echo $venta["nombre"]." ".$venta["apellido"] ?></small>
                </div>
                 <div class="col-md-5">
                    <a href="#?id=<?php echo $venta["id"] ?>" id="ver_tipos_dev" class = "btn btn-info"><small> Realizar devolución  </small> </a>
                </div>
                <div class=" col-md-12 row pt-4">
                    <?php $numero_fac =  $venta["numero_factura"]; ?>
                    <div class="col-md-10 " id="tipos_dev">
                        <button class="btn btn-secondary" id="busqueda_articulos"><i class="fa-solid fa-cart-flatbed"></i> Artículos</button>
                        <a class="btn btn-secondary" href="../backend/ventas/devolucion_completa.php?factura=<?php echo $numero_fac?>"><i class="fa-solid fa-cash-register"></i> Fáctura</a>
                    </div>
                </div>
                
                    
                <?php
                }
              ?>
       
        <script>
             $('#tipos_dev').hide();
            $('#ver_tipos_dev').click(function(){
                $('#tipos_dev').show(1000);
            });

        $("#busqueda_articulos").click(function()
        {
            $("#caja_articulos").show();
            var Factura = $("#factura").val();
            $.ajax
            ({
                type:"post",
                url:"busquedas/buscar_factura_articulos.php",
                dataType:'html',
                data:{'factura':Factura },
                success: function(data)
                {
                    $("#caja_articulos").empty();
                    $("#caja_articulos").append(data);
                }
            });  
        });
        </script>