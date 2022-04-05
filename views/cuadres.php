<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');

 $usuario = $_SESSION["usuario_logueado"];
 $consulta_cuadres= "SELECT * FROM cuadres order by id  desc";
 $query_cuadres = $conexion->query($consulta_cuadres);

 $consulta_cuadres_filtro= "SELECT * FROM cuadres where usuario_inicio = '$usuario' and estado = 'Abierto'";
 $query_cuadres_filtro = $conexion->query($consulta_cuadres_filtro);
 $resultados = $query_cuadres_filtro->num_rows;



?>

<div class="p-5 contenido">
  <h3>Cuadres</h3>
        <div class="row">
            <div class="col-md-2">
                <?php
                    if($resultados < 1)
                    {
                ?>
                    <button class="btn btn-secondary ps-5 pe-5 mb-3" id="iniciar">Inicio de dia</button>
                <?php
                    }
                ?>

            </div>
            <div class="col-md-6" id="encontrado">
                <form action="../backend/ventas/inicio_dia.php" method="post">
                    <div class="row">
                        
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="inicio" id="" placeholder="cantidad en caja">  
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary">Iniciar</button> 
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar Cuadre"><br>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Usuario</th>
      <th scope="col">Fecha</th>
      <th scope="col">Encontrado</th>
      <th scope="col">Sistema</th>
      <th scope="col">Cierre dia</th>
      <th scope="col">Diferencia</th>
      <th scope="col">Estado</th>
      <th scope="col">Reabrir</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($cuadres = $query_cuadres->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $cuadres["id"] ?></th>
                <td><?php echo $cuadres["usuario_inicio"] ?></td>
                <td><?php echo $cuadres["fecha_creacion"] ?></td>
                <td><?php echo $cuadres["encontrado"] ?></td>
                <td><?php echo $cuadres["sistema"] ?></td>
                <td><?php echo $cuadres["cierre"] ?></td>
                <td><?php echo $cuadres["cierre"] - ($cuadres["encontrado"] + $cuadres["sistema"] )?></td>
                <td>
                    <small>
                        <?php
                                if($cuadres["estado"]=='Abierto'){
                                    $id= $cuadres["id"];
                                    ?>
                                        <a href="cuadre.php?id=<?php echo $id ?>" class="btn btn-info"><i class="fa-solid fa-check"></i> Abierto</a>
                                    <?php
                                }
                                else{
                                    ?>
                                        <a  class= "btn btn-danger"><i class="fa-regular fa-circle-xmark"></i> Cerrado</a>
                                    <?php
                                }
                        ?>
                    </small>
                </td>
                <td>
                    <small>
                        <a href = "../backend/ventas/reabrir_cierre.php?id=<?php $id= $cuadres["id"]; echo $id ?>"  class="btn btn-info">Abrir</a>
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

<script>
    $("#encontrado").hide();
    $("#iniciar").click(function(){
        $("#encontrado").toggle();
    });
</script>
