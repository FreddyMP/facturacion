<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_pacientes.php');
 $consulta = "SELECT id, nombres, apellidos, fecha_ingreso, tipo_sangre FROM registro_pacientes";
 $query_all = $conexion->query($consulta);

?>

<div class="p-5 contenido">
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar paciente"><br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col" width="15%">Nombre</th>
      <th scope="col" width="15%">Apellido</th>
      <th scope="col">Fecha ingreso</th>
      <th scope="col">Tipo de sangre</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($pacientes = $query_all->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $pacientes["id"] ?></th>
                <td><?php echo $pacientes["nombres"]?></td>
                <td><?php echo $pacientes["apellidos"]?></td>
                <td><?php echo $pacientes["fecha_ingreso"]?></td>
                <td><?php echo $pacientes["tipo_sangre"]?></td>
                <td>
                    <small>
                        <a href="cliente.php?id=<?php echo $pacientes["id"] ?>" class="btn btn-info">Ver</a>
                        <a class= "btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $pacientes["id"] ?>">del</a>
                    </small>
                </td>
            </tr>
            <div class="modal fade" id="exampleModal<?php echo $pacientes["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $pacientes["nombre"] ?></h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Eliminar este paciente?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href='../backend/clientes/delete.php?id=<?php echo $pacientes["id"] ?>' type="button" class="btn btn-Danger">Eliminar</a>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
      ?>
  </tbody>
</table>
        </div>
</div>
