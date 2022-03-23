<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_clientes.php');
?>
<form action="../backend/clientes/crear.php" method="post">

<div class="p-3 contenido">
        <div class="col-md-12">
            <H3>Crear paciente</H3><br>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1" placeholder="Inserte el nombre del paciente">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Apellido</label>
                    <input type="text" class="form-control" name="apellido" id="exampleFormControlInput1" placeholder="Inserte el apellido del paciente">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" id="exampleFormControlInput1" placeholder="Ej; 000-000-0000">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Celular</label>
                    <input type="text" class="form-control" name="celular" id="exampleFormControlInput1" placeholder="Ej; 000-000-0000">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Cédula</label>
                    <input type="text" class="form-control" name="cedula" id="exampleFormControlInput1" placeholder="Ej; 000-00000000-0">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Número de record</label>
                    <input type="Number" name="record" class="form-control" placeholder="Inserte el numero del record">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Cita previa</label>
                    <input type="date" name="previa" class="form-control" placeholder="Stock">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Próxima Cita</label>
                    <input type="date" name="proxima" class="form-control" placeholder="Stock">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Notas</label>
                    <textarea class="form-control" name="notas" id="exampleFormControlTextarea1" placeholder="Detalles a tomar en cuenta acerca del paciente" rows="3"></textarea>
                </div>
               
                <div class="col-md-6 mt-3">
                    <button class= "btn btn-primary">Guardar</button>
                </div>
                
            
            </div>
        </div>
</div>
</form>