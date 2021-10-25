<?php
 include('plantilla/menu_top.php');
 include('plantilla/menu_usuarios.php');
?>
<form action="../backend/usuarios/crear_roles.php" method="post">

<div class="container p-3">
        <div class="col-md-12">
            <H3>Crear Rol</H3><br>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1" placeholder="Inserte el nombre del rol">
                </div>
                <h3>Permisos</h3>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Crear artículos</label>
                    <select class="form-control" name="crear_articulos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Eliminar artículos</label>
                    <select class="form-control" name="eliminar_articulos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar artículos</label>
                    <select class="form-control" name="modificar_articulos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Cargar cantidades a inventario</label>
                    <select class="form-control" name="cargar_cantidades" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pasar inventario</label>
                    <select class="form-control" name="pasar_inventario" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Ver artículos en movimiento</label>
                    <select class="form-control" name="ver_movimientos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Retornar artículos en movimiento</label>
                    <select class="form-control" name="retornar_movimientos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Crear almacenes</label>
                    <select class="form-control" name="crear_almacenes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar almacenes</label>
                    <select class="form-control" name="modificar_almacenes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Eliminar almacenes</label>
                    <select class="form-control" name="eliminar_almacenes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Crear categorías</label>
                    <select class="form-control" name="crear_categorias" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar categorías</label>
                    <select class="form-control" name="modificar_categorias" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Eliminar categorías</label>
                    <select class="form-control" name="eliminar_categorias" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Ver las categorías</label>
                    <select class="form-control" name="ver_categorias" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Facturar</label>
                    <select class="form-control" name="facturar" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Reportes</label>
                    <select class="form-control" name="reportes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Cuadre de cajas</label>
                    <select class="form-control" name="cuadre_caja" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Crear devoluciones</label>
                    <select class="form-control" name="devoluciones" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Poner ventas en espera</label>
                    <select class="form-control" name="poner_espera" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Retomar ventas en espera</label>
                    <select class="form-control" name="retomar_espera" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Crear clientes</label>
                    <select class="form-control" name="crear_clientes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar clientes</label>
                    <select class="form-control" name="modificar_clientes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Eliminar Clientes</label>
                    <select class="form-control" name="eliminar_clientes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Crear roles</label>
                    <select class="form-control" name="crear_roles" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar roles</label>
                    <select class="form-control" name="modificar_roles" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Eliminar roles</label>
                    <select class="form-control" name="eliminar_roles" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Crear usuarios</label>
                    <select class="form-control" name="crear_usuarios" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar usuarios</label>
                    <select class="form-control" name="modificar_usuarios" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Eliminar usuarios</label>
                    <select class="form-control" name="eliminar_usuarios" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Crear códigos de impuestos</label>
                    <select class="form-control" name="crear_codigos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar códigos de impuestos</label>
                    <select class="form-control" name="modificar_codigos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Eliminar códigos de impuestos</label>
                    <select class="form-control" name="eliminar_codigos" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Modificar la secuencia de los comprobantes</label>
                    <select class="form-control" name="modificar_comprobantes" id="">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
               
                <div class="col-md-6 mb-5">
                    <button class= "btn btn-primary">Guardar</button>
                </div>
                
            
            </div>
        </div>
</div>
</form>