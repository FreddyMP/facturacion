<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 include('../backend/inventario/listas_articulos.php');
 $consulta_articulos2 = "SELECT * FROM articulos where borrado_por is null";
 $query_articulos = $conexion->query($consulta_articulos2);
?>

<div class="container p-5">
    <h3>Cargar inventario</h3>
    <?php
        while($articulo = $query_articulos->fetch_assoc()){
            ?>
                <div class="col-md-12">
                    <input type="text" class="form-control" name="" id="" placeholder="Buscar artículo"><br>
                <div class="alert alert-dark" role="alert">
                Código - <?php echo $articulo["id"]." Articulo - ".$articulo["nombre"]?>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <select class="form-control " name="" id="">
                            <option value="">Almacen 1</option>
                            <option value="">Almacen 2</option>
                            <option value="">Almacen 3</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <input type="number" class="form-control" placeholder="Cantidad para agregar">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary">Agregar</button>
                    </div>
                </div>
                
                
            </div>
        </div>
            <?php
        }
    ?>
        
</div>
