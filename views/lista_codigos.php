<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_impuestos.php');
 $consulta_impuestos = "SELECT * FROM impuestos";
 $query_impuestos = $conexion->query($consulta_impuestos);
?>

<div class="p-5">
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar paciente"><br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col" width="15%">Nombre</th>
      <th scope="col" width="15%">Tipo</th>
      <th scope="col">Porcentaje total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($impuestos = $query_impuestos->fetch_assoc()){
            $id = $impuestos["id"];
            $consulta_detalles_sum = "SELECT SUM(porcentaje) as porcentaje FROM impuestos_detalles where cabecera = $id ";
            $query_detalles_sum = $conexion->query($consulta_detalles_sum);
            $cabecera = $query_detalles_sum->fetch_assoc();
        ?>
            <tr>
                <th scope="row"><?php echo $impuestos["id"] ?></th>
                <td><?php echo $impuestos["nombre"]?></td>
                <td><?php echo $impuestos["tipo"]?></td>
                <td><?php echo $cabecera["porcentaje"]?></td>
                <td><button class="btn btn-info">Historial</button></td>
            </tr>
        <?php
        }
      ?>
  </tbody>
</table>
        </div>
</div>
