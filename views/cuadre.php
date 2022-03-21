<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_ventas.php');

 $usuario = $_SESSION["usuario_logueado"];
 $consulta_cuadres= "SELECT * FROM cuadres ";
 $query_cuadres = $conexion->query($consulta_cuadres);

 $consulta_cuadres_filtro= "SELECT * FROM cuadres where usuario_inicio = '$usuario' and estado = 'Abierto'";
 $query_cuadres_filtro = $conexion->query($consulta_cuadres_filtro);
 $resultados = $query_cuadres_filtro->num_rows;

?>
    
    <div class="row p-5 contenido">
        <h3 >Conteo en caja</h3>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3 efe" placeholder="$1" id="uno" required>
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$5"  id="cinco" required>
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$10"   id="diez" required>

        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$20"   id="veinte" required>
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$25"   id="veinticinco" required>
            
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$50"   id="cincuenta" required>
            
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$100"  id="cien" required>
        
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$200"   id="dosciento" required>
          
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$500"   id="quiniento" required>
           
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$1,000"  id="mil" required>
           
        </div>
        <div class="col-md-2">
            <input type="number" min="0" class="form-control m-3  efe" placeholder="$2,000"   id="dosmil" required>
          
        </div>
        <form action="../backend/ventas/cierre_dia.php" method="post">
            <span class="m-3"><strong>Total</strong> </span>
            <input type="number" disabled value="0" class="form-control m-3 total">
            <input type="hidden" value="0" class="form-control m-3 total" name="total">
            <input type="hidden"  value="<?php echo $_GET['id'] ?>"name="id">
            <button class="btn btn-primary m-3">Guardar</button>
        </form>
    </div>
    
        
<script>
    

    $(".efe").keyup(function(){
        uno = $("#uno").val();
        cinco = $("#cinco").val() * 5;
        diez = $("#diez").val() * 10;
        veinte = $("#veinte").val() * 20;
        veinticinco = $("#veinticinco").val() * 25;
        cincuenta = $("#cincuenta").val() * 50;
        cien = $("#cien").val() * 100;
        dosciento = $("#dosciento").val() * 200;
        quiniento = $("#quiniento").val() * 500;
        mil = $("#mil").val() * 1000;
        dosmil = $("#dosmil").val() * 2000;

        total = parseFloat(uno) + parseFloat(cinco) + parseFloat(diez) + parseFloat(veinte) +   parseFloat(veinticinco) +   parseFloat(cincuenta) +   parseFloat(cien) +   parseFloat(dosciento) +   parseFloat(quiniento) +   parseFloat(mil) +   parseFloat(dosmil) ; 
        $(".total").val(total);
    });
  
</script>
