
<div class="btn-group">
   <?php if($resultado_rol["crear_articulos"]==1){
       ?>
            <a href="crear_articulo.php" type="button" class="btn btn-secondary " >Crear artículo</a>
       <?php
   } 
  
       ?>
            <a href="inventario.php" type="button" class="btn btn-secondary ">Lista de artículos</a>
        <?php
    if($resultado_rol["cargar_cantidades_a_inventario"]==1){
       ?>
            <a href="cargas_a_inventario.php" type="button" class="btn btn-secondary ">Cargar inventario</a>
        <?php
   } 
    if($resultado_rol["pasar_inventario"]==1){
        ?>
            <a href="pasar_inventario.php" type="button" class="btn btn-secondary ">Pasar inventario</a>
        <?php
   } 
   if($resultado_rol["ver_articulos_en_movimiento"]==1){
        ?>
            <a href="articulos_en_movimiento.php" type="button" class="btn btn-secondary ">Artículos en movimiento</a>
        <?php
   }    
   if($resultado_rol["crear_almacenes"]==1){
        ?>
            <a href="crear_almacen.php" type="button" class="btn btn-secondary " >Crear almacén</a>
        <?php
   } 
        ?>
            <a href="lista_almacenes.php" type="button" class="btn btn-secondary ">Lista de almacenes</a>
        <?php
 
   if($resultado_rol["crear_categorias"]==1){
        ?>
            <a href="crear_categorias.php" type="button" class="btn btn-secondary ">Crear categorias</a>
        <?php
   } 
    ?>
        <a href="lista_categoria.php" type="button" class="btn btn-secondary ">Lista de categorías</a>
    <?php

   ?>
</div>