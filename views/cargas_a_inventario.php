<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 //include('../backend/inventario/listas_articulos.php');
 $consulta_articulos = "SELECT * FROM articulos where borrado_por is null limit 10";
 $query_articulos = $conexion->query($consulta_articulos);
?>

<div class="p-5 contenido">
    <h3>Cargar inventario</h3>
        <div class="col-md-12">
            <input type="text" class="form-control" id="busqueda" placeholder="Buscar artículo"><br>
            
            <div role="alert" id="caja_init">
                <?php
                    while($articulo = $query_articulos->fetch_assoc())
                    {
                ?>
                <div class="alert alert-dark">
                <strong>Código   <?php echo $articulo["id"].":</strong> ".$articulo["nombre"]?>
                <form action="../backend/inventario/cargar_cantidades.php" method="post">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="alert-primary p-4">
                                <?php
                                    $id_almacen = $articulo["almacen"];
                                     $consulta_almacen = "SELECT * from almacenes where id = $id_almacen";
                                    $query_almacen = $conexion->query($consulta_almacen);
                                    $resultado = $query_almacen->fetch_assoc();
                                    echo $resultado["nombre"];
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <input type="text" disabled value="Existencia: <?php echo $articulo["existencia"]?>" class="form-control" placeholder="Cantidad Actual">
                        </div>
                        <div class="col-md-6 ">
                            <input type="number" name="cantidad" class="form-control" placeholder="Cantidad para agregar"> 
                        </div> <br>
                        <div class="col-md-6">
                            <input type="hidden" name="id" value="<?php echo $articulo["id"]?>">
                            <button class="btn btn-primary">Agregar</button>
                        </div>   
                    </div>
                </form>
                </div>
                <?php
                }
            ?>
            </div>
            <div id="caja_busqueda">
                
            </div>
        </div>  
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$("#busqueda").keyup(function()
        {
          if( $("#busqueda").val() != ''){
            $("#caja_init").hide();
            $("#caja_busqueda").show();
            var articulo = $("#busqueda").val();
            $.ajax
            ({
                type:"post",
                url:"busquedas/buscar_articulos_cargar.php",
                dataType:'html',
                data:{'nombre':articulo},
                success: function(data)
                {
                    $("#caja_busqueda").empty();
                    $("#caja_busqueda").append(data);
                }
            }); 
          }else{
            $("#caja_init").show();
            $("#caja_busqueda").hide();
          }
            
        });
</script>