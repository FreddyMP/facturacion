<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_impuestos.php');
?>
<script src="../js/jquery-mask/src/jquery.mask.js"></script>
<div class="container p-5 contenido">
        <div class="col-md-12">
            <H3>Crear tipo de comprobante</H3><br>
            <form action="../backend/impuestos/crear_comprobante.php" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <label for="exampleFormControlInput1" class="form-label">Código</label>
                        <input type="text" disabled class="form-control" value="0" placeholder="000005">
                    </div>
                    <div class="col-md-10 mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tipo de comprobante</label>
                        <input type="text" name="nombre" class="form-control"placeholder="Insertar el nombre comprobante" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Código de comprobante</label>
                        <input type="text" name="codigo" class="form-control" placeholder="Iniciacion del tipo de comprobante Ej: B01">
                    </div>
                    <div  class="col-md-4 mb-3">
                        <div id="simple">
                            <label for="exampleFormControlTextarea1" class="form-label">Próximo</label>
                            <input type="number" name="proximo" class="form-control"placeholder="0">
                        </div>
                    </div>
                    <div  class="col-md-4 mb-3">
                        <div id="simple">
                            <label for="exampleFormControlTextarea1" class="form-label">Límite</label>
                            <input type="number" name="limite" class="form-control"placeholder="0">
                        </div>
                    </div>
                </div>
                <button class= "btn btn-primary">Guardar</button>
            </form>
            
        </div>
</div>
