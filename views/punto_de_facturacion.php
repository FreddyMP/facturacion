<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');
 //include('../backend/ventas/lista_articulos.php');
 include('../backend/control/cone.php');

    $usuario = $_SESSION["usuario_logueado"];

    #todos los articulos activos
    $consulta_clientes = "SELECT id, nombre FROM pacientes where status = 'Activo' and borrado_por is null and fecha_borrado is null";
    $consulta_comprobantes = "SELECT id, nombre from tipos_comprobantes where borrado_por is null"

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="p-5">
        <div class="row">
            <div class="col-md-4 p-4" style="border:solid 1px; border-radius: 5px;"  >
              <Strong>Información</Strong>  
                <hr>
                <form action="../backend/ventas/registrar_venta.php"  target = "_blank" method="post" >
                <?php
                    if(isset($_GET["codigo"])){
                        $codigo = $_GET["codigo"];
                        ?>
                            <input type="hidden" value="<?php echo $codigo ?>" name="codigo" id="codigo_get">
                        <?php
                    }
                ?>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Cliente</label>
                            <select class="form-control" name="cliente" id="">
                                <?php 
                                    $query_clientes = $conexion->query($consulta_clientes);
                                    while($clientes = $query_clientes->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $clientes["id"]; ?>"> <?php echo $clientes["nombre"];?> </option>
                                        <?php
                                    }
                                ?>
                                
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="exampleFormControlInput1" class="form-label" id="ee">Forma de pago</label>
                            <select class="form-control" name="forma" id="">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Condición de pago</label>
                                <select class="form-control" name="condicion" id="">
                                    <option value="Al contado">Al contado</option>
                                    <option value="15 Dias">15 dias</option>
                                    <option value="30 Dias">30 Dias</option>
                                </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Comprobante</label>
                                <select class="form-control" name="comprobante" id="">
                                <?php 
                                    $query_comprobantes = $conexion->query($consulta_comprobantes);
                                    while($comprobantes = $query_comprobantes->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $comprobantes["id"];?>"> <?php echo $comprobantes["nombre"];?> </option>
                                        <?php
                                    }
                                ?>
                                </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary " id='facturado'>Facturar</button>
                        </div>
                    </div>
                </form>
                <hr>
               <strong>Lista de artículos</strong> 
                <input class="form-control mb-3" type="text" placeholder="Buscar artículo" id="buscar_art">
                <div class="row">
                    <div class="col-md-3">
                           <strong> Cod. Art</strong>
                    </div>
                    <div class="col-md-2">
                           <strong> Cod. Imp</strong>
                    </div>
                    <div class="col-md-2">
                           <strong> Precio</strong>
                    </div>
                    <div class="col-md-2">
                           <strong> Cant.</strong>
                    </div>
                    <div class="col-md-1">
                           <strong>ADD</strong>
                    </div>

                </div>
                <div id="caja_articulos">
                
                </div>
                
            </div>
            <div class="col-md-7 p-4" style="border:solid 1px; border-radius: 5px; margin-left:50px" >
                <strong>Artículos agregados</strong> 
                <hr><div class="row">
                    <div class="col-md-1 bg-primary p-2 mb-2  text-light">
                            Código
                    </div>
                    <div class="col-md-4 bg-secondary p-2 mb-2  text-light">
                            Nombre
                    </div>
                    <div class="col-md-2  bg-secondary p-2 mb-2  text-light">
                            Cantidad
                    </div>
                    <div class="col-md-2  bg-secondary p-2 mb-2  text-light">
                            Itbis
                    </div>
                    <div class="col-md-2  bg-secondary p-2 mb-2 text-light">
                            Precio total
                    </div>
                    <div class="col-md-1  bg-secondary p-2 mb-2 text-light">
                           Quitar
                    </div>
                <?php
                        if(isset($_GET["codigo"])){
                            $codigo = $_GET["codigo"];
                            $consulta_code = "SELECT * from venta_detalle where codigo = '$codigo'";
                            $query_code = $conexion->query($consulta_code);
                            
                            while($lista_arti = $query_code->fetch_assoc()){
                                ?>
                                
                                    <div class="col-md-1 mb-3">
                                        <?php
                                            echo $lista_arti["id_articulo"];
                                        ?>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <?php
                                            echo $lista_arti["articulo"] ;
                                        ?>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <?php
                                            echo $lista_arti["cantidad"] ;
                                        ?>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <?php
                                            echo "RD$"." ". $lista_arti["total_itbis"] ;
                                        ?>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <?php
                                           echo "RD$"." ".$lista_arti["total_con_itbis"] ;
                                        ?>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <a href="../backend/ventas/borrar_detalle.php?id=<?php echo $lista_arti["id"]?>&codigo=<?php echo $lista_arti["codigo"]?>" class="btn btn-danger"><strong> X</strong></a>
                                    </div>
                                
                                <hr>
                                <?php
                            }
                        }
                ?>
                </div>
                <div class="mt-5">
                    <div class="row">
                        <?php
                        if(isset($_GET["codigo"])){
                            $codigo = $_GET["codigo"];
                            $consulta_totales = "SELECT SUM(total_itbis) as itbis,SUM(total_sin_itbis) as total_sin, SUM(total_con_itbis) as total from venta_detalle where codigo = '$codigo'";
                            $query_consulta = $conexion->query($consulta_totales);
                            $total= $query_consulta->fetch_assoc();
                        ?>
                        <div class="col-md-4">
                        Totales:
                        </div>
                        <div class="col-md-2">
                           Itbis: RD$ <?php echo round($total["itbis"],2) ?>
                        </div>
                        <div class="col-md-3">
                           Bruto: RD$ <?php echo round($total["total_sin"],2) ?>
                        </div>
                        <div class="col-md-2">
                           Neto: RD$ <?php echo round($total["total"],2) ?>
                        </div>
                        <div class="col-md-1">
                           <a href = "../backend/ventas/limpiar_venta.php?codigo=<?php echo $codigo?>"class="btn btn-danger">X</a> 
                        </div>
                        <?php
                        }
                            ?>

                    </div>
                </div>
            </div>
        
        </div>
      
       

</div>
<script>
$("#buscar_art").keyup(function()
        {
            var articulo = $("#buscar_art").val();
            var codigo_detalles = $("#codigo_get").val();
            $.ajax
            ({
                type:"post",
                url:"buscar_articulo.php",
                dataType:'html',
                data:{'nombre':articulo,'codigo':codigo_detalles},
                success: function(data)
                {
                    $("#caja_articulos").empty();
                    $("#caja_articulos").append(data);
                }
            }); 
        });



$("#facturado").click(function(){
    $(location).attr('href','punto_de_facturacion.php');
});
</script>
