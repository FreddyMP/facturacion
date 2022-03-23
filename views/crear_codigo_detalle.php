<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_impuestos.php');
 $id = $_GET["id"];
 $consulta_detalles = "SELECT * FROM impuestos_detalles where cabecera = $id";
 $query_detalle = $conexion->query($consulta_detalles);
?>
<div class="p-5 contenido">
        <div class="col-md-12  mb-5">
            <H3>Crear código de impuestos</H3><br>
<form action="../backend/impuestos/compuesto.php" method="post">
                <div id="complejo" class="row mb-3">
                <div class="row">
                    <input  type="hidden" name="cabecera" value="<?php echo $id ?>">
                    <div class="col-md-4">
                        <label for="exampleFormControlTextarea1" class="form-label">Destino</label>
                        <input type="Text" name="destino" class="form-control"placeholder="Impuesto referente a:">
                    </div>
                    <div class="col-md-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Porcentaje</label>
                        <input type="number" name="porcentaje" class="form-control"placeholder="0">
                    </div>
                    <div class="col-md-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Agregar linea</label><br>
                        <button class= "btn btn-dark">+</button>
                    </div>
                </div>
                </div>
            </form>
            </div>
            <div class="row">
                <div class = "col-md-6">
                    Destino
                </div>
                <div class = "col-md-6">
                    Porcentaje
                </div>
            </div><hr>
            <div class="row">
                <?php
                    while($resultados_detalles = $query_detalle->fetch_assoc()){
                        ?>
                            <div class = "col-md-6">
                                <?php echo $resultados_detalles["destino"]; ?>
                            </div>
                            <div class = "col-md-6">
                                <?php echo $resultados_detalles["porcentaje"]."%"; ?>
                            </div>
                        <?php
                    }
                ?>
                
            </div>
</div>
