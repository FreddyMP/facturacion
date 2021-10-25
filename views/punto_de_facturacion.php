<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');
 include('../backend/ventas/lista_articulos.php');

?>

<div class="p-5">
        <div class="row">
            <div class="col-md-4 p-4" style="border:solid 1px; border-radius: 5px;"  >
                Información
                <hr>
                <form action="../backend/ventas/registrar_venta.php" method="post">
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
                                    $consulta_clientes = "SELECT id, nombre FROM pacientes where status = 'Activo' and borrado_por is null and fecha_borrado is null";
                                    $query_clientes = $conexion->query($consulta_clientes);
                                    while($clientes = $query_clientes->fetch_assoc()){
                                        ?>
                                            <option value="<?php echo $clientes["id"]; ?>"> <?php echo $clientes["nombre"];?> </option>
                                        <?php
                                    }
                                ?>
                                
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Forma de pago</label>
                            <select class="form-control" name="forma" id="">
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Condición de pago</label>
                                <select class="form-control" name="condicion" id="">
                                    <option value="Al contado">Al contado</option>
                                    <option value="15 Dias">15 dias</option>
                                    <option value="30 Dias">30 Dias</option>
                                </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary ">Facturar</button>
                        </div>
                    </div>
                </form>
                <hr>
                Lista de artículos
                <input class="form-control mb-3" type="text" placeholder="Buscar artículo">
                <?php
                    while($articulos = $query_all->fetch_assoc()){
                ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php
                            echo $articulos['id'];   
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                            echo $articulos['nombre'];   
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                            echo "RD$".$articulos['precio_venta'];   
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
                                            <input type="hidden" name="articulo" value="<?php echo $articulos['id']; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <button class = "btn btn-primary">ADD</button>
                                            </div>
                                        </div>
                                    </form>

                                        
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                
            </div>
            <div class="col-md-7 p-4" style="border:solid 1px; border-radius: 5px; margin-left:50px" >
                Artículos agregados
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
