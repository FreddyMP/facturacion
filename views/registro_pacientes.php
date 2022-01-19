<?php
include('plantilla/menu_top.php');
include('plantilla/menu_pacientes.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="m-4">
        <h4>Datos generales</h4> 
        <form action="../backend/pacientes/registro_pacientes.php" method="post">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <label for=""><strong> Fecha de ingreso </strong></label>
                    <input class="form-control" type="date" name="fecha_ingreso" id="">
                </div>
                <div class="col-md-2">
                    <label for=""><strong> Hora de ingreso </strong></label>
                    <input class="form-control " type="time" name="hora_ingreso" id="">
                </div>
                <div class="col-md-6">
                    <label for=""><strong> Origen de admisión</strong></label><br>
                    <select class="form-control" name="origen" id="">
                        <option value="Emergencia">
                            Emergencia
                        </option>
                        <option value="Traslado">
                            Traslado
                        </option>
                        <option value="Referimiento">
                            Referimiento
                        </option>
                    </select>
                    <div style="display:none">
                        ¿Fue un referimiento coordinado?
                        Si
                        <input value="si" type="radio"name="ori" id="referido">
                        No
                        <input value="no" type="radio"name="ori" id="no_referido">
                        <input class="form-control " type="text" name="" id="nombre_referido" placeholder="Centro de referimieto">
                    </div>
                   
                </div>
                <br>
                <div class="col-md-3 mb-4">
                    <label for=""><strong> No. Expediente</strong></label>
                    <input class="form-control " type="text" name="num_expediente" id="" placeholder="No. expediente">
                </div>
                <div class="col-md-3">
                    <label for=""><strong> No. NSS</strong></label>
                    <input class="form-control " type="text" name="nss" id="" placeholder="No. ">
                </div>
                <div class="col-md-3">
                    <label for=""><strong> Seguro</strong></label>
                    <input class="form-control " type="text" name="seguro" id="" placeholder="Seguro">
                </div>
                <div class="col-md-3">
                    <label for=""><strong> No. del seguro</strong></label>
                    <input class="form-control " type="text" name="num_seguro" id="" placeholder="No. de seguro">
                </div>
                <div class="col-md-4">
                    <label for=""><strong> Nombres</strong></label>
                    <input class="form-control " type="text" name="nombre" id="" placeholder="No. ">
                </div>
                <div class="col-md-4">
                    <label for=""><strong> Apellidos</strong></label>
                    <input class="form-control " type="text" name="apellido" id="" placeholder="No. expediente">
                </div>
                <div class="col-md-4 mb-4">
                    <label for=""><strong> Nacionalidad</strong></label>
                    <input class="form-control " type="text" name="nacionalidad" id="" placeholder="No. ">
                </div>
                <label ><strong> Fecha de nacimiento</strong></label>
                <div class="input-group ">
                    <div class="col-md-3 mb-4">
                        <input class="form-control " type="date" name="fecha_nacimiento" id="" placeholder="No. ">
                    </div>
                    <div class="col-md-2">
                        <input class="form-control " type="Time" name="hora_nacimiento" id="" placeholder="No. ">
                    </div>
                    <div class="col-md-1">
                        <input class="form-control " disabled type="Text" name="" id="" placeholder="Edad">
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <label for=""><strong> Genero</strong></label>
                    <select class="form-control " name="genero">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for=""><strong> Peso(kg)</strong></label>
                    <input class="form-control " type="text" name="peso" id="" placeholder="Peso corporal">
                </div>
                <div class="col-md-4">
                    <label for=""><strong> Altura(cm)</strong></label>
                    <input class="form-control " type="text" name="altura" id="" placeholder="Altura fisica">
                </div>
                <div class="col-md-4 mb-4">
                    <label for=""><strong> Lugar de nacimiento</strong></label>
                    <input class="form-control " type="text" name="lugar_nacimiento" id="" placeholder="Lugar de nacimiento">
                </div>
                <div class="col-md-4">
                    <label for=""><strong> Lugar donde vive</strong></label>
                    <input class="form-control " type="text" name="lugar_vive" id="" placeholder="Lugar donde vive">
                </div>
                <div class="col-md-4">
                    <label for=""><strong> Dirección</strong></label>
                    <input class="form-control " type="Text" name="direccion" id="" placeholder="Dirección">
                </div>
                <div class="col-md-6 mb-4">
                    <label for=""><strong> Responsable</strong></label>
                    <input class="form-control " type="Text" name="responsable" id="" placeholder="Responsable">
                </div>
                <div class="col-md-6">
                    <label for=""><strong> Relación</strong></label>
                    <input class="form-control " type="Text" name="relacion" id="" placeholder="Relació">
                </div>
                <div class="col-md-6 mb-4">
                    <label for=""><strong>Tipo de sangre</strong></label>
                    <select class="form-control" name="sangre">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for=""><strong>Alergias</strong></label>
                    <textarea class="form-control" name="alergias" id="" cols="30" rows="3">

                    </textarea>
                </div>
                <div class="col-md-6 mb-6">
                    <button class="btn btn-primary">Guardar registro</button>
                </div>

            </div>
        </form>
    </div>
</body>
</html>
<script>
$("#nombre_referido").hide();
$("#no_referido").attr('checked',true);

$("#referido").change(function(){
    $("#nombre_referido").show();
})
$("#no_referido").change(function(){
    $("#nombre_referido").hide();
})






</script>