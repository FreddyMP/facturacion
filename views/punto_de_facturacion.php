<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');
 //include('../backend/ventas/lista_articulos.php');
 include('../backend/control/cone.php');

    $usuario = $_SESSION["usuario_logueado"];

    #todos los articulos activos
    $consulta_all = "SELECT id, nombre, precio_venta, existencia, stock, cantidad_disponible, codigo_impuesto from articulos  where status = 'Activo' and borrado_por is null and fecha_borrado is null";
    $query_all = $conexion->query($consulta_all);
    $consulta_clientes = "SELECT id, nombre FROM pacientes where status = 'Activo' and borrado_por is null and fecha_borrado is null";
    $consulta_comprobantes = "SELECT id, nombre from tipos_comprobantes where borrado_por is null"

?>

<div class="p-5">
        <div class="row">
            <div class="col-md-4 p-4" style="border:solid 1px; border-radius: 5px;"  >
              <Strong>Información</Strong>  
                <hr>
                <form action="../backend/ventas/registrar_venta.php"  target = "_blank" method="post" >
                <?php
                    if(isset($_GET["codigo"])){
                        $codigo= $_GET["codigo"];
                        ?>
                            <input type="hidden" value="<?php echo $codigo ?>" name="codigo">
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
                                <option value="Tarjeta">Tarjeta</option>
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
                            <label for="exampleFormControlInput1" class="form-label">Tipo de comprobante</label>
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
                <input class="form-control mb-3" type="text" placeholder="Buscar artículo">
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
                <?php
                    while($articulos = $query_all->fetch_assoc()){

                ?>
                <div class="row"> 
                    <div class="col-md-3">
                        <?php
                            echo $articulos['nombre'];   
                        ?>
                    </div>
                    <div class="col-md-2">
                        <?php
                            echo $articulos['codigo_impuesto'];  
                        ?>
                    </div>
                    <div class="col-md-2">
                        <?php
                            echo $articulos['precio_venta'];  
                        ?>
                    </div>
                    <div class="col-md-3">
                        <form action="../backend/ventas/registrar_detalles.php" method="post">
                            <div class="row">
                                <div class="col-md-8">
                                    <?php
                                        if(isset($_GET['codigo']))
                                        {
                                            $codigo = $_GET['codigo'];
                                        ?>
                                            <input type="hidden" name="codigo" value="<?php echo $codigo?>">
                                        <?php
                                            }
                                        ?>
                                            <input type="number" name="cantidad" value="1" class="form-control"  placeholder="Cant." id="">
                                            <input type="hidden" name="name" value="<?php echo $articulos['nombre']; ?>">
                                            <input type="hidden" name="impuesto" value="<?php echo $articulos['codigo_impuesto']; ?>">
                                            <input type="hidden" name="articulo" value="<?php echo $articulos['id']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <button class = "btn btn-primary">ADD</button>
                                            </div>
                                        </div>
                                    </form>

                                        
                                </div><hr>
                            </div>
                            <?php
                             }
                    ?>
                
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
$("#facturado").click(function(){
    $(location).attr('href','punto_de_facturacion.php');
});
</script>
