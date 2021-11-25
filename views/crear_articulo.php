<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 include('../backend/control/cone.php');
 include('../backend/inventario/relaciones_articulos.php');
 include('../backend/impuestos/all_codigos.php');
?>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="../js/jquery-mask/src/jquery.mask.js"></script>
<script src="../js/mascaras.js"></script>
<form action="../backend/inventario/crear_articulo.php" method="post">
<div class="container p-3">
        <div class="col-md-12">
            <H3>Crear nuevo artículo</H3><br>
            <div class="row">
                <div class="col-md-2 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Código</label>
                    <input type="text" class="form-control codigo" disabled value="<?php echo $resultado["id"]+1; ?>"  id="exampleFormControlInput1" placeholder="000005">
                </div>
                <div class="col-md-10 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre del artículo</label>
                    <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1" placeholder="Ej; Aspirina 200ml">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Existencia actual</label>
                    <input type="Number" name="existencia" class="form-control"  step="0.1" placeholder="Cantidad que existe actualmente">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label" >Stock mínimo</label>
                    <input type="Number" name="stock" class="form-control" step="0.001" placeholder="Stock">
                </div>
                <!--<div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Formato cuantitativo compra</label>
                    <select class="form-control" name="fcc" id="">
                        <option value="Unidad">Unidad</option>
                        <option value="Caja">Caja</option>
                        <option value="Libra">Libras</option>
                        <option value="Galón">Galón</option>
                    </select>
                </div> -->
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Formato cuantitativo</label>
                    <select class="form-control" name="fcv" id="">
                        <option value="Unidad">Unidad</option>
                        <option value="Caja">Caja</option>
                        <option value="Libra">Libras</option>
                        <option value="Galón">Galón</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Estado</label>
                    <select class="form-control" name="estado" id="">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Categorias</label>
                    <select class="form-control" name="categoria" id="">
                    <?php 
                            while($resultado_categorias = $query_categorias->fetch_assoc()){
                                ?>
                                        <option value="<?php echo $resultado_categorias["id"]  ?>"><?php echo $resultado_categorias["nombre"] ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Precio de compra</label>
                    <input type="Number" name="precio_c"  step="0.01" class="form-control" placeholder="0.00">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Precio de venta</label>
                    <input type="Number" name="precio_v"  step="0.01" class="form-control" placeholder="0.00">
                </div>
                
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Laboratorio</label>
                    <input type="Text" name="casa_productora" class="form-control" placeholder="Casa productora o laboratorio">
                </div> 
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Código de impuesto</label>
                    <select class="form-control" name="impuestos" id="">
                        <?php
                            while($codigos = $query_impuestos->fetch_assoc()){
                            ?>
                            <option value="<?php echo $codigos["id"] ?>"><?php echo $codigos["nombre"] ?></option>
                            <?php
                            }
                        ?>
                        
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlInput1" class="form-label">Almacén</label>
                    <select class="form-control" name="almacen" id="">
                        <?php 
                            while($resultado_almacenes = $query_almacenes->fetch_assoc()){
                                ?>
                                        <option value="<?php echo $resultado_almacenes["id"]  ?>"><?php echo $resultado_almacenes["nombre"] ?></option>
                                <?php
                            }
                        ?>
                        
                    </select>
                </div> 
                <div class="col-md-6 mt-3">
                    <button class= "btn btn-primary">Guardar</button>
                </div>
                
            
            </div>
        </div>
</div>
</form>
