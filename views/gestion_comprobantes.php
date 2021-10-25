<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_impuestos.php');
 include('../backend/inventario/listas_articulos.php');
 $consulta_comprobantes = "SELECT * FROM tipos_comprobantes where borrado_por is null";
 $query_comprobantes = $conexion->query($consulta_comprobantes);
?>
<div class="p-5">
<h3>Lista de comprobantes</h3>
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar almacén"><br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo</th>
      <th scope="col">Próximo</th>
      <th scope="col">Límite</th>
      <th scope="col">Restante</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($comprobantes = $query_comprobantes->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $comprobantes["id"] ?></th>
                <td><?php echo $comprobantes["nombre"] ?></td>
                <td><?php echo $comprobantes["codigo"] ?></td>
                <td><?php echo $comprobantes["proximo"] ?></td>
                <td><?php echo $comprobantes["limite"] ?></td>
                <td><?php echo $comprobantes["limite"] - $comprobantes["proximo"]+1  ?></td>
                <td>
                    <small>
                        <button class="btn btn-info">Ver</button>
                        <button class= "btn btn-danger">del</button>
                    </small>
                </td>
            </tr>
        <?php
        }
      ?>
  </tbody>
</table>
        </div>
</div>
