<?php
include("../../backend/control/cone.php");
$nombre = $_POST["nombre"];
$consulta_busqueda = "SELECT * from articulos where nombre like '%$nombre%' and borrado_por is null and fecha_borrado is null";
$query_articulos = $conexion->query($consulta_busqueda);

                while($articulo2 = $query_articulos->fetch_assoc())
                {
            ?>
            <div class="alert alert-dark" role="alert">

                Código  <?php echo $articulo2["id"].": ".$articulo2["nombre"]?>
                <form action="../backend/inventario/cargar_cantidades.php" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="alert-primary p-4">
                                <?php
                                    $id_almacen2 = $articulo2["almacen"];
                                     $consulta_almacen2 = "SELECT * from almacenes where id = $id_almacen2";
                                    $query_almacen2 = $conexion->query($consulta_almacen2);
                                    $resultado2 = $query_almacen2->fetch_assoc();
                                    echo $resultado2["nombre"];
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="text" disabled value="Existencia: <?php echo $articulo2["existencia"]?>" class="form-control" placeholder="Cantidad Actual">
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="number" name="cantidad" class="form-control" placeholder="Cantidad para agregar"> 
                        </div> 
                        <div class="col-md-6">
                            <input type="hidden" name="id" value="<?php echo $articulo2["id"]?>">
                            <button class="btn btn-primary">Agregar</button>
                        </div>   
                    </div>
                </form>
            </div>
            <?php
                }
            ?>