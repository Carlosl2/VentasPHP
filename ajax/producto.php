<?php 
ob_start();
if (strlen(session_id()) < 1){
	session_start();//Validamos si existe o no la sesión
}
if (!isset($_SESSION["nombre"]))
{
  header("Location: ../vistas/login.html");//Validamos el acceso solo a los usuarios logueados al sistema.
}
else
{
//Validamos el acceso solo al usuario logueado y autorizado.
if ($_SESSION['acceso']==1)
{
require_once "../modelos/Producto.php";

$producto=new Producto();

$idproducto=isset($_POST["idproducto"])? limpiarCadena($_POST["idproducto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$presentacion=isset($_POST["presentacion"])? limpiarCadena($_POST["presentacion"]):"";
$valor_unitario=isset($_POST["valor_unitario"])? limpiarCadena($_POST["valor_unitario"]):"";
$cantidad_actual=isset($_POST["cantidad_actual"])? limpiarCadena($_POST["cantidad_actual"]):"";
$fktipo_producto=isset($_POST["fktipo_producto"])? limpiarCadena($_POST["fktipo_producto"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idproducto)){
			$rspta=$producto->insertar($nombre,$descripcion,$presentacion,$valor_unitario, $cantidad_actual, $fktipo_producto);
			echo $rspta ? "Producto registrado"  : "Producto no se pudo registrar";
		}
		else {
			$rspta=$producto->editar($idproducto,$nombre,$descripcion,$presentacion,$valor_unitario, $cantidad_actual,$fktipo_producto);
			echo $rspta ? "Producto  actualizado" : "Producto no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$producto->desactivar($idproducto);
 		echo $rspta ? "Producto Desactivado" : "Producto no se puede desactivar";
	break;

	case 'activar':
		$rspta=$producto->activar($idproducto);
 		echo $rspta ? "Producto activado" : "Producto no se puede activar";
	break;

	case 'mostrar':
		$rspta=$producto->mostrar($idproducto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'eliminar':
		$rspta=$producto->eliminar($idproducto);
 		echo $rspta ? "tipo_producto activado" : "tipo_producto no se puede activar";
	break;

	case 'listar':
		$rspta=$producto->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$data[]=array(
				"9"=>($reg->fkestado)==2 ?'<button class="btn btn-warning" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger" onclick="desactivar('.$reg->idproducto.')"><i class="fa fa-close"></i></button>':
					'<button class="btn btn-warning" onclick="mostrar('.$reg->idproducto.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary" onclick="activar('.$reg->idproducto.')"><i class="fa fa-check"></i></button>'.
					' <button class="btn btn-default" onclick="eliminar('.$reg->idproducto.')"><i class="fa fa-eraser"></i></button>',
				"0"=>$reg->idproducto,
				"1"=>$reg->nombre,
                "2"=>$reg->descripcion,
                "3"=>$reg->presentacion,
                "4"=>$reg->valor_unitario,
                "5"=>$reg->cantidad_actual,
                "6"=>$reg->fktipo_producto,
                "7"=>$reg->fecha_hora,
				"8"=>($reg->fkestado==2)?'<span class="label bg-green">Activado</span>':
				'<span class="label bg-red">Desactivado</span>'
				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

    case "selectTipoProducto":
		require_once "../modelos/Producto.php";
		$producto = new Producto();

		$rspta = $producto->selectTipoProducto();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idtipo_producto . '>' . $reg->tipo_producto . '</option>';
				}
	break;
}
//Fin de las validaciones de acceso
}
else
{
  require 'noacceso.php';
}
}
ob_end_flush();
?>