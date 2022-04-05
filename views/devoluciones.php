<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');

 $usuario = $_SESSION["usuario_logueado"];
 $consulta_devoluciones= "SELECT * FROM devoluciones order by id_devolucion  desc";
 $query_devolucion = $conexion->query($consulta_devoluciones);



?>

<div class="p-5 contenido">
  <h3>Devoluciones</h3>
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-secondary ps-5 pe-5 mb-3" id="iniciar" data-bs-toggle="modal" data-bs-target="#exampleModalx">Nueva</button>
            </div>
        </div>
        <div class="col-md-12">
            <input type="text" class="form-control" name="" id="" placeholder="Buscar Cuadre"><br>

<div class="modal fade" id="exampleModalx" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Realizar devoluciones</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="row">
            <div class="col-md-10 p-3">
                <input type="text" class="form-control" name="" id="factura" placeholder= "Número de fáctura">
            </div>
            <div class="col-md-2 p-3">
                <i id="busqueda" class="fa-solid fa-magnifying-glass fa-2x "></i>
            </div>
        </div>
        <hr>
      <div id="factura">
        <div class="modal-body row">
            <div class="col-md-3">
                <strong> <small>Num. Fáctura </small></strong>
            </div>
            <div class="col-md-4">
                <strong><small> Cliente </small></strong>
            </div>
            <div class="col-md-3">
                <strong> <small>Action</small></strong>
            </div>
        </div>
        <div class="modal-body row" id="caja_busqueda">
            
        </div>
        <div class="modal-body" id="caja_articulos">
            
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


        <table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Fáctura</th>
      <th scope="col">Tipo</th>
      <th scope="col">Razón</th>
    </tr>
  </thead>
  <tbody>
      <?php
        while($devoluciones_result = $query_devolucion->fetch_assoc()){
        ?>
            <tr>
                <th scope="row"><?php echo $devoluciones_result["id_devolucion"] ?></th>
                <td><?php echo $devoluciones_result["numero_factura"] ?></td>
                <td><?php echo $devoluciones_result["tipo_devolucion"] ?></td>
                <td><?php echo $devoluciones_result["id_razon"] ?></td>
            </tr>
        <?php
        }
      ?>
  </tbody>
</table>
        </div>
</div>

<script src="../bootstrap/jquery.min.js"></script>
<script>
$("#busqueda").click(function()
        {
            $("#caja_busqueda").show();
            var Factura = $("#factura").val();
            $.ajax
            ({
                type:"post",
                url:"busquedas/buscar_factura.php",
                dataType:'html',
                data:{'factura':Factura },
                success: function(data)
                {
                    $("#caja_busqueda").empty();
                    $("#caja_busqueda").append(data);
                }
            });  
        });

     
</script>