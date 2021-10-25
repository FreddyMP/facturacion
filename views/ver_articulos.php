<?php
include('plantilla/menu_top.php');
include('plantilla/menu_articulos.php');
include('../backend/inventario/listas_articulos.php');
$id= $_GET["id"];
$consulta_id = "SELECT * from articulos where id = $id";
$query_id = $conexion->query($consulta_id);
$articulo = $query_id->fetch_assoc();

?>
<form action="../backend/inventario/modificar_articulo.php" method="post">

<div class="container p-5">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <label for="exampleFormControlInput1" class="form-label">Código</label>
                    <input type="text" class="form-control" disabled value= "<?php echo $articulo["id"] ?>" id="exampleFormControlInput1" placeholder="000005">
                </div>
                <div class="col-md-10">
                    <label for="exampleFormControlInput1" class="form-label">Nombre del artículo</label>
                    <input type="text" class="form-control" disabled value= "<?php echo $articulo["nombre"] ?>" name="nombre" id="exampleFormControlInput1" placeholder="Ej; Aspirina 200ml">
                </div>
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                    <textarea class="form-control"disabled name="descripcion"  id="exampleFormControlTextarea1" rows="3"><?php echo $articulo["descripcion"] ?></textarea>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Existencia actual</label>
                    <input type="Number" name="existencia" disabled value= "<?php echo $articulo["existencia"] ?>"  class="form-control" placeholder="Cantidad que existe actualmente">
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Stock mínimo</label>
                    <input type="Number" name="stock" disabled class="form-control" value= "<?php echo $articulo["stock"] ?>"  placeholder="Stock">
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Formato cuantitativo compra</label>
                    <select class="form-control" disabled name="fcc" id="">
                        <option value="<?php echo $articulo["fcc"] ?>"><?php echo $articulo["fcc"] ?></option>
                        <option value="Unidad">Unidad</option>
                        <option value="Caja">Caja</option>
                        <option value="Libra">Libras</option>
                        <option value="Galón">Galón</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Formato cuantitativo venta</label>
                    <select class="form-control" disabled name="fcv" id="">
                    <option value="<?php echo $articulo["fcv"] ?>"><?php echo $articulo["fcv"] ?></option>
                        <option value="Unidad">Unidad</option>
                        <option value="Caja">Caja</option>
                        <option value="Libra">Libras</option>
                        <option value="Galón">Galón</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Estado</label>
                    <select class="form-control" disabled name="estado" id="">
                    <option value="<?php echo $articulo["status"] ?>"><?php echo $articulo["status"] ?></option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Categorias</label>
                    <select class="form-control" disabled name="categoria" id="">
                    <option value="<?php echo $articulo["categoria"] ?>"><?php echo $articulo["categoria"] ?></option>
                        <option value="test">Calmantes</option>
                        <option value="test">Antibioticos</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Precio de compra</label>
                    <input type="Number" disabled value="<?php echo $articulo["precio_compra"] ?>" name="precio_c" class="form-control" placeholder="0.00">
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Precio de venta</label>
                    <input type="Number" disabled name="precio_v" value="<?php echo $articulo["precio_venta"] ?>" class="form-control" placeholder="0.00">
                </div>
                <div class="col-md-12">
                    <label for="exampleFormControlInput1" class="form-label">Laboratorio</label>
                    <input type="Text" disabled value="<?php echo $articulo["casa_productora"] ?>" name="casa_productora" class="form-control" placeholder="Casa productora o laboratorio">
                </div> <br>
                <div class="col-md-12 mt-3">
                    <button class= "btn btn-primary col-md-4">Guardar</button>
                </div>
                
            
            </div>
        </div>
</div>
</form>