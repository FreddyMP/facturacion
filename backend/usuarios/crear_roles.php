<?php
 $nombre = $_POST["nombre"];
 $crear_articulos= $_POST["crear_articulos"];
 $modificar_articulos = $_POST["modificar_articulos"];
 $eliminar_articulos= $_POST["eliminar_articulos"];
 $cargar_cantidades = $_POST["cargar_cantidades"];
 $retornar_movimientos = $_POST["retornar_movimientos"];
 $pasar_inventario = $_POST["pasar_inventario"];
 $ver_movimientos = $_POST["ver_movimientos"];
 $crear_almacenes = $_POST["crear_almacenes"];
 $modificar_almacenes = $_POST["modificar_almacenes"];
 $eliminar_almacenes = $_POST["eliminar_almacenes"];
 $crear_categorias = $_POST["crear_categorias"];
 $modificar_categorias = $_POST["modificar_categorias"];
 $eliminar_categorias = $_POST["eliminar_categorias"];
 $ver_categorias = $_POST["ver_categorias"];
 $facturar= $_POST["facturar"];
 $reportes = $_POST["reportes"];
 $cuadre_caja = $_POST["cuadre_caja"];
 $devoluciones = $_POST["devoluciones"];
 $venta_espera = $_POST["poner_espera"];
 $retomar_venta = $_POST["retomar_espera"];
 $crear_cliente = $_POST["crear_clientes"];
 $modificar_clientes = $_POST["modificar_clientes"];
 $eliminar_clientes = $_POST["eliminar_clientes"];
 $crear_roles = $_POST["crear_roles"];
 $modificar_roles = $_POST["modificar_roles"];
 $eliminar_roles = $_POST["eliminar_roles"];
 $crear_usuarios = $_POST["crear_usuarios"];
 $modificar_usuarios = $_POST["modificar_usuarios"];
 $eliminar_usuarios = $_POST["eliminar_usuarios"];
 $crear_codigos = $_POST["crear_codigos"];
 $modificar_codigos = $_POST["modificar_codigos"];
 $eliminar_codigos = $_POST["eliminar_codigos"];
 $modificar_comprobantes = $_POST["modificar_comprobantes"];


include('../control/cone.php');
session_start();
$usuario = $_SESSION["usuario_logueado"];

$conexion->query("INSERT INTO roles_y_permisos (`rol`, `crear_articulos`, `modificar_articulos`, `eliminar_articulo`, `cargar_cantidades_a_inventario`, 
`retornar_articulos_en_movimiento`,
 `pasar_inventario`, `ver_articulos_en_movimiento`, `crear_almacenes`, `modificar_almacenes`, `eliminar_almacenes`, `crear_categorias`, `modificar_categorias`, `eliminar_categorias`,
  `ver_categorias`, `facturar`, `reporte`, `cuadre_caja`, `devoluciones`, `venta_en_espera`, `retomar_venta_en_espera`, `crear_clientes`, `modificar_clientes`, `eliminar_clientes`,
   `crear_roles`, `modificar_roles`, `eliminar_roles`, `crear_usuarios`, `modificar_usuarios`, `eliminar_usuarios`, `crear_codigo_impuestos`, `modificar_codigo_impuestos`, 
   `eliminar_codigo_impuestos`, `modificar_comprobantes`, `creado_por`)
 values ('$nombre',$crear_articulos,$modificar_articulos,$eliminar_articulos,$cargar_cantidades,$retornar_movimientos,$pasar_inventario,$ver_movimientos,$crear_almacenes,$modificar_almacenes,
 $eliminar_almacenes,$crear_categorias,$modificar_categorias, $eliminar_categorias,$ver_categorias,$facturar, $reportes,$cuadre_caja,$devoluciones,$venta_espera, $retomar_venta,$crear_cliente,
 $modificar_clientes,$eliminar_clientes,$crear_roles,$modificar_roles,$eliminar_roles,$crear_usuarios,$modificar_usuarios,$eliminar_usuarios,$crear_codigos,$modificar_codigos,$eliminar_codigos,
 $modificar_comprobantes,'$usuario')");

 header('location: ../../views/lista_roles.php');
 ?>