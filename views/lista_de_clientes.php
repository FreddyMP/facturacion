<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_clientes.php');
 include('../backend/clientes/ver.php');
?>

<div class="p-5 contenido">
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar paciente"><br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col" width="15%">Nombre</th>
      <th scope="col" width="15%">Apellido</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Historial</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($cliente = $query_all->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $cliente["id"] ?></th>
                <td><?php echo $cliente["nombre"]?></td>
                <td><?php echo $cliente["apellido"]?></td>
                <td><?php echo $cliente["telefono"]?></td>
                <td><button class="btn btn-info">Historial</button></td>
                <td>
                    <small>
                        <a href="cliente.php?id=<?php echo $cliente["id"] ?>" class="btn btn-info">Ver</a>
                        <a class= "btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $cliente["id"] ?>">del</a>
                    </small>
                </td>
            </tr>
            <div class="modal fade" id="exampleModal<?php echo $cliente["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $cliente["nombre"] ?></h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Eliminar este paciente?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href='../backend/clientes/delete.php?id=<?php echo $cliente["id"] ?>' type="button" class="btn btn-Danger">Eliminar</a>
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
