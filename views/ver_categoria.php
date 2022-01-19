<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_articulos.php');
 $id = $_GET["id"];

 $consulta = "SELECT * from categorias where id = $id";
 $query = $conexion->query($consulta);
 $result = $query->fetch_assoc();

?>
<div class="container p-5">
        <div class="col-md-12">
            <H3>Crear categoría</H3><br>
            <form action="../backend/inventario/modificar_categoria.php" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <label for="exampleFormControlInput1" class="form-label">Código</label>
                        <input disabled value="<?php echo $result['id'] ?>" type="text" class="form-control" placeholder="000005">
                        <input disabled value="<?php echo $result['id'] ?>" name="id" type="hidden" class="form-control acti" placeholder="000005">
                    </div>
                    <div class="col-md-10">
                        <label for="exampleFormControlInput1" class="form-label">Categoría</label>
                        <input disabled value="<?php echo $result['nombre'] ?>"  type="text" name="nombre" class="form-control acti"placeholder="Ej; Electricos">
                    </div>
                    <div class="col-md-12">
                        <label for="exampleFormControlTextarea1" class="form-label">Descripción</label>
                        <textarea disabled class="form-control acti" name="descripcion" id="exampleFormControlTextarea1" rows="3"> <?php echo $result['descripcion'] ?></textarea>
                    </div>
                    <div class="col-md-6">
                            <a class= "btn btn-warning col-md-12 mt-3" id= "editar">Editar</a>
                    </div>
                    <div class="col-md-6">
                            <button disabled  class= "btn btn-primary col-md-12 mt-3 acti">Guardar</button>
                    </div>
                </div>
                
            </form>
        </div>
</div>
<script>
    $("#editar").click(function(){
        $(".acti").attr("disabled", false);
    });
</script>