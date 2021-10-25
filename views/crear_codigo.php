<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_impuestos.php');
 $consulta_ultimo = "SELECT id from impuestos order by id desc";
 $query_ultimo = $conexion->query($consulta_ultimo);
 $resultado_ultimo = $query_ultimo->fetch_assoc();
 //inicializados hace referencia si es el primer codigo de impuestos
 $existencia = $query_ultimo->num_rows;
 if($existencia > 0 ){
    $inizializados = $resultado_ultimo["id"] + 1;
 }
 else{
    $inizializados="PRIMERO";
 }
 

?>
<script src="../js/jquery-mask/src/jquery.mask.js"></script>
<div class="container p-5">
        <div class="col-md-12">
            <H3>Crear código de impuestos</H3><br>
            <form action="../backend/impuestos/crear.php" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <label for="exampleFormControlInput1" class="form-label">Código</label>
                        <input type="text" disabled class="form-control" value="<?php echo $inizializados  ?>" placeholder="000005">
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nombre del código de impuestos</label>
                        <input type="text" name="nombre" class="form-control"placeholder="Ej: 16% Selectivo al consumo" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Tipo de código</label>
                        <select  id = "tipo" name="tipo" class="form-control" id="">
                            <option  value="Simple">Simple</option>
                            <option value="Compuesto">Compuesto</option>
                        </select>
                    </div>
                    <div  class="col-md-8 mb-3">
                        <div id="simple">
                            <label for="exampleFormControlTextarea1" class="form-label">Porcentaje</label>
                            <input type="number" name="porcentaje" class="form-control"placeholder="0">
                        </div>
                        
                    </div>
                </div>
                <button class= "btn btn-primary">Guardar</button>
            </form>
            
        </div>
</div>

<<script>
$(document).ready(function(){
    $("#complejo").hide();
    $("#tipo").change(function(){
        tipo = $("#tipo").val();
        if(tipo === "Simple"){
            $("#simple").show();
            $("#complejo").hide();
        }
        else{
            $("#complejo").show();
            $("#simple").hide();
        }
            
    
    });
 
});
</script>