<?php
include('../backend/control/cone.php');
 
 if(isset($_POST["nombre"])){
    $nombre = $_POST["nombre"];
 }
 else{
    $nombre = " ";
 }
 if(isset($_POST["codigo"])){
    $codigo = $_POST["codigo"];
 }
?>
<div  style="height: 350px; overflow-y: scroll; ">
<?php
 $articul = $nombre;
  $consulta_all = "SELECT id, nombre, precio_venta, existencia, stock, cantidad_disponible, codigo_impuesto 
  from articulos 
where nombre like '%$articul%'  and status = 'Activo' and borrado_por is null and fecha_borrado is null";
  $query_all = $conexion->query($consulta_all); 
                    while($articulos = $query_all->fetch_assoc()){

                ?>
                <div class="row" > 
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
                                        if(isset($_POST['codigo']))
                                        {
                                            $codigo = $_POST['codigo'];
                                        ?>
                                            <input type="hidden" name="codigo" value="<?php echo $codigo?>">
                                        <?php
                                            }
                                        ?>
                                    <input type="number" name="cantidad" max="<?php echo $articulos['cantidad_disponible']-$articulos['stock']; ?>" min="1" value="1" class="form-control"  placeholder="Cant." id="">
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