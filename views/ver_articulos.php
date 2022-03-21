<?php
include('plantilla/menu_top.php');
include('plantilla/menu_articulos.php');
include('../backend/inventario/listas_articulos.php');
$id= $_GET["id"];
$consulta_id = "SELECT * from articulos where id = $id ";
$query_id = $conexion->query($consulta_id);
$articulo = $query_id->fetch_assoc();
$consulta_categoria_nombre = "SELECT * from categorias where borrado_por is null and fecha_borrado is null";
$query_categoria = $conexion->query($consulta_categoria_nombre);
?>
<form action="../backend/inventario/modificar_articulo.php" method="post">
<div class="container p-5 contenido">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <label for="exampleFormControlInput1" class="form-label">Código</label>
                <input type="text" class="form-control"  disabled value= "<?php echo $articulo["id"] ?>" id="exampleFormControlInput1" placeholder="000005">
                <input type="hidden" class="form-control" name="id"  value= "<?php echo $articulo["id"] ?>" id="exampleFormControlInput1" placeholder="000005">
            </div>
            <div class="col-md-10 ">
                <label for="exampleFormControlInput1" class="form-label">Nombre del artículo</label>
                <input type="text" class="form-control acti" name="nombre" required disabled value= "<?php echo $articulo["nombre"] ?>" name="nombre" id="exampleFormControlInput1" placeholder="Ej; Aspirina 200ml">
            </div>
            <div class="col-md-12">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                <textarea class="form-control acti"disabled name="descripcion" required  id="exampleFormControlTextarea1" rows="3"><?php echo $articulo["descripcion"] ?></textarea>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Existencia actual</label>
                <input type="Number" name="existencia" disabled value= "<?php echo $articulo["existencia"] ?>"  class="form-control" placeholder="Cantidad que existe actualmente">
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1"  class="form-label">Stock alerta</label>
                <input type="Number" name="stock" required disabled class="form-control acti" value= "<?php echo $articulo["stock"] ?>"  placeholder="Stock">
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Almacen</label>
                <?php
                    $id_almacen = $articulo['almacen'] ;
                    $consulta_almacen_id = "SELECT * from almacenes where id =  $id_almacen";
                    $consulta_almacen_all = "SELECT * from almacenes where borrado_por is null and fecha_borrado is null";

                    $query_id = $conexion->query($consulta_almacen_id);
                    $query_all = $conexion->query($consulta_almacen_all);

                    $resultado_almacen_id = $query_id->fetch_assoc();
                ?>
                <select class="form-control acti"  disabled name="almacen" id="">
                    <option value="<?php echo $articulo["almacen"] ?>"><?php echo $resultado_almacen_id["nombre"] ?></option>
                    <?php
                    while($resultado_almacen_all = $query_all->fetch_assoc())
                    {
                    ?>
                        <option value="<?php echo $articulo["id"] ?>"><?php echo $resultado_almacen_all["nombre"]?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlInput1" class="form-label">Formato cuantitativo</label>
                <select class="form-control acti" disabled name="fcv" id="">
                    <option value="<?php echo $articulo["fcv"] ?>"><?php echo $articulo["fcv"] ?></option>
                    <option value="Unidad">Unidad</option>
                    <option value="Caja">Caja</option>
                    <option value="Libra">Libras</option>
                    <option value="Galón">Galón</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="exampleFormControlInput1" class="form-label">Estado</label>
                <select class="form-control acti" disabled name="estado" id="">
                    <option value="<?php echo $articulo["status"] ?>"><?php echo $articulo["status"] ?></option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
            
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Precio compra</label>
                <input type="Number" disabled id="precio_compra" name="precio_c"   step="0.01" value="<?php echo $articulo['precio_compra'] ?>" class="form-control acti" placeholder="0.00">
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Porcentaje de ganancia</label>
                <?php
                    $ganancia = $articulo['precio_venta'] - $articulo['precio_compra'] ;
                    $porciento =$ganancia/ $articulo['precio_compra'] * 100;
                ?>
                <input type="Number" disabled  id="porciento" step="0.01" value="<?php echo $porciento?>" class="form-control acti" placeholder="0.00">
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Precio venta</label>
                <input type="Number" disabled id="venta_visible" step="0.01"  value="<?php echo $articulo['precio_venta'] ?>" class="form-control" placeholder="0.00">
                <input type="hidden" name="precio_v" step="0.01"  id='venta_oculta' value="<?php echo $articulo['precio_venta'] ?>" class="form-control " placeholder="0.00">
            </div>

            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Laboratorio</label>
                <input type="Text" disabled value="<?php echo $articulo["casa_productora"] ?>"  name="casa_productora" class="form-control acti" placeholder="Casa productora o laboratorio">
            </div>

            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Categorias</label>
                <select class="form-control acti"  disabled name="categoria" id="">
                <?php    
                    $id_categoria = $articulo['categoria'] ;
                    $consulta_categoria_id = "SELECT * from categorias where id = $id_categoria";
                    $query_id = $conexion->query($consulta_categoria_id);
                    $resultado_categoria_id = $query_id->fetch_assoc();
                ?>
                    <option value="<?php echo $resultado_categoria_id["id"] ?>"><?php echo $resultado_categoria_id["nombre"] ?></option>
                    <?php
                        while($resultado_categorias = $query_categoria->fetch_assoc()){
                           ?>
                                <option value="<?php echo $resultado_categorias["id"] ?>"><?php echo $resultado_categorias["nombre"] ?></option>
                           <?php
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="exampleFormControlInput1" class="form-label">Cod. impuesto</label>
                <?php
                    $id_impuesto = $articulo['codigo_impuesto'] ;
                    $consulta_impuesto_id = "SELECT * from impuestos where id =  $id_impuesto";
                    $consulta_impuesto_all = "SELECT * from impuestos where borrado_por is null and fecha_borrado is null";

                    $query_impuesto_id = $conexion->query($consulta_impuesto_id);
                    $query_impuesto_all = $conexion->query($consulta_impuesto_all);

                    $resultado_impuesto_id = $query_impuesto_id->fetch_assoc();
                ?>
                <select class="form-control acti"  disabled name="impuesto" id="">
                    <option value="<?php echo $resultado_impuesto_id["id"] ?>"><?php echo $resultado_impuesto_id["nombre"] ?></option>
                    <?php
                        while($resultado_impuesto_all = $query_impuesto_all->fetch_assoc()){
                            ?>
                                <option value="<?php echo $resultado_impuesto_all["id"] ?>"><?php echo $resultado_impuesto_all["nombre"] ?></option>
                            <?php
                        }
                    ?>
                </select>
            </div>
            
            <br>

            <div class="col-md-6 mt-3" id="editar">
                <a class= "btn btn-warning col-md-12">Editar</a>
            </div>
            <div class="col-md-6 mt-3">
                <button class= "btn btn-primary col-md-12">Guardar</button>
            </div> 
        </div>
    </div>
</div>
</form>

<script>
    $("#editar").click(function(){
        $(".acti").attr("disabled", false);
    });

    $("#precio_compra").change(function(){
        compra = $("#precio_compra").val();
        porciento = $("#porciento").val();
        porciento_real = parseFloat(compra) / 100 * parseFloat(porciento);
        sum = parseFloat(compra) + parseFloat(porciento_real);
        $("#venta_visible").val(sum);
        $("#venta_oculta").val(sum);
    }); 
    $("#porciento").change(function(){
        compra = $("#precio_compra").val();
        porciento = $("#porciento").val();
        porciento_real = parseFloat(compra) / 100 * parseFloat(porciento);
        sum = parseFloat(compra) + parseFloat(porciento_real);
        $("#venta_visible").val(sum);
        $("#venta_oculta").val(sum);
    }); 
</script>