<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
?>
<div class="container p-5">
        <div class="col-md-12">
            <H3>Crear categoría</H3><br>
            <form action="../backend/inventario/crear_categoria.php" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <label for="exampleFormControlInput1" class="form-label">Código</label>
                        <input type="text" class="form-control" placeholder="000005">
                    </div>
                    <div class="col-md-10">
                        <label for="exampleFormControlInput1" class="form-label">Categoría</label>
                        <input type="text" name="nombre" class="form-control"placeholder="Ej; Electricos">
                    </div>
                    <div class="col-md-12">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
                <button class= "btn btn-primary">Guardar</button>
            </form>
        </div>
</div>
